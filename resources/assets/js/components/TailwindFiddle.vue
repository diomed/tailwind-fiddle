<template>
    <div class="flex flex-col">
        <div class="w-full flex-1 overflow-hidden overflow-y-scroll antialiased" v-html="source">
        </div>

        <div class="w-full flex flex-col items-center" style="height: 20rem;">
            <div class="w-full h-6 px-2 bg-grey-lighter inline-flex items-center">
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer select-none tracking-wide uppercase "
                     v-on:click="clear">
                    Clear
                </div>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcDemo)">
                    Demo
                </div>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcSelf)">
                    Inception
                </div>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcAbout)">
                    About
                </div>
                <div class="pl-1 text-xs text-grey-dark">|</div>
                <div class="pr-1 text-xs text-grey-dark">|</div>
                <a class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer select-none tracking-wide uppercase no-underline"
                   href="https://tailwindcss.com/docs/what-is-tailwind/"
                   target="_blank"
                   rel="nofollow noopener">Docs</a>
            </div>
            <div class="w-full relative flex flex-1">
                <div id="editor" class="w-full flex-1 py-1 font-mono leading-tight border-grey-light z-10 bg-transparent">
                </div>
                <!-- <textarea
                    id="editor"
                    class="w-full flex-1 py-1 font-mono text-xs border-grey-light leading-tight z-10 bg-transparent"
                    name="name" rows="8" cols="80"
                    v-model="source"
                    v-on:keydown.delete.prevent="keydownDelete"
                    placeholder="Your awesome HTML with Tailwind CSS goes here. Hit Demo or About above to see what's this about 💡">
                </textarea> -->
                <div class="absolute pin-t pin-r">
                    <div class="invisible lg:visible text-5xl m-4 font-bold text-grey-lighter">
                        Tailwind Fiddle
                    </div>
                </div>
            </div>
            <div class="h-8 flex items-center">
                <div class="text-xs flex items-center">
                    <span>Made with</span>
                    <a href="https://tailwindcss.com/">
                        <svg class="w-4 h-4 mx-1" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 11.1C15.3 3.9 19.8.3 27 .3c10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 27.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" transform="translate(5 16)" fill="url(#logoGradient)" fill-rule="evenodd"></path></svg>
                    </a>
                    <span>by</span>
                    <a class="mx-1 antialiased no-underline text-blue" href="https://twitter.com/mkarnicki">
                        <strong>@mkarnicki</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'placeholder',
            'srcDemo',
            'srcSelf',
            'srcAbout'
        ],
        data: function () {
            return {
                editorId: 'editor',
                editor: Object,
                source: ''
            };
        },
        mounted () {
            tabOverride.tabSize(4);
            tabOverride.set(this.$refs.editor);
        },
        methods: {
            clear: function () {
                this.editor.setValue('', 1);
            },
            loadSource: function (source) {
                this.editor.setValue(source, 1);
                this.editor.scrollToLine(0);
            }
        },
        mounted () {
        	this.editor = window.ace.edit(this.editorId);
            this.editor.setTheme(`ace/theme/tomorrow`);
            // this.editor.style.fontSize='12px'; // Doesn't seem to work.
            this.editor.on('change', () => {
                this.source = this.editor.getValue();
            });

            let session = this.editor.getSession();
            session.setMode(`ace/mode/html`);
            session.setTabSize(4);
            session.setUseSoftTabs(true);
            session.setUseWrapMode(true);
            // Modified snippet from: https://groups.google.com/forum/#!topic/ace-discuss/qOVHhjhgpsU
            // We really want to hide the missing doctype warning.
            session.on("changeAnnotation", function() {
                let annotations = session.getAnnotations() || [];
                let i = annotations.length;
                let len = 0;
                while (i--) {
                    if (/doctype first\. Expected/.test(annotations[i].text)) {
                        annotations.splice(i, 1);
                        session.setAnnotations(annotations);
                    }
                }
            });

            let visitedAlready = localStorage.getItem('introSeen');
            if (visitedAlready == null) {
                this.loadSource(this.placeholder);
                localStorage.setItem('introSeen', true);
            }

        } // --- methods
    }
</script>
