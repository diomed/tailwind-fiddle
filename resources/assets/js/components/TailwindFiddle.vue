<template>
    <div class="flex flex-col">
        <div class="w-full flex-1 overflow-hidden overflow-y-scroll antialiased" v-html="source">
        </div>

        <div class="w-full flex flex-col items-center" style="height: 20rem;">
            <div class="w-full bg-grey-lighter inline-flex flex-wrap items-strech">
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase "
                     v-on:click="clear">
                    Clear
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase "
                     v-on:click="center">
                    Center
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase "
                     ref="gistMenuItem"
                     v-on:click="toggleGistPanel">
                    Gist
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcAbout)">
                    About
                </div>
                <a class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase no-underline"
                   href="https://tailwindcss.com/docs/what-is-tailwind/"
                   target="_blank"
                   rel="nofollow noopener">Docs</a>
                <div class="px-1 py-2 text-xs text-grey-dark">|</div>
                <div class="px-2 py-2 text-xs text-grey-dark select-none tracking-wide uppercase">
                    Demo:
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcDemo)">
                    one
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcDemo2)">
                    two
                </div>
                <div class="px-2 py-2 text-xs text-grey-dark text-blue hover:text-purple hover:bg-grey-light cursor-pointer select-none tracking-wide uppercase"
                     v-on:click="loadSource(srcSelf)">
                    three
                </div>

            </div>
            <div ref="gistPanel" class="w-full h-auto px-2 bg-grey-lighter hidden items-center">
                <div
                    v-if="gistHtmlUrl"
                    class="my-2 inline-flex flex-wrap items-center">
                    <button
                        ref="gistClearButton"
                        type="button"
                        name="clearGist"
                        class="w-16 mb-1 px-2 py-2 font-semibold text-sm text-grey-darker border"
                        @click="clearGist">
                        Clear
                    </button>
                    <a
                        v-bind:href="gistHtmlUrl"
                        target="_blank"
                        rel="nofollow noopener"
                        class="mx-2 text-sm no-underline text-blue hover:text-purple">{{ gistHtmlUrl }}</a>
                </div>
                <div
                    v-else
                    class="my-2 inline-flex flex-wrap items-center">
                    <button
                        ref="gistSaveButton"
                        type="button"
                        name="saveGist"
                        class="w-16 mb-1 px-2 py-2 font-semibold text-sm text-grey-darker border"
                        @click="saveToGist">
                        Save
                    </button>
                    <span class="mx-2 mb-1 md:mb-0 text-sm text-grey">Both optional:</span>
                    <input
                        ref="gistFilename"
                        type="text"
                        name="filename"
                        placeholder="Filename (no .html)"
                        class="mr-2 mb-1 md:mb-0 px-2 py-1 w-full md:w-64 font-mono text-xs">
                    <input
                        ref="gistDescription"
                        type="text"
                        name="description"
                        placeholder="Description"
                        class="mr-2 mb-1 md:mb-0 px-2 py-1 w-full md:w-64 font-mono text-xs">
                    <input
                        ref="gistIsPublic"
                        type="checkbox"
                        name="public"
                        checked="checked"
                        class="mr-2 mb-1 md:mb-0 px-2 py-1 text-xs">
                    <label class="mr-2 py-1 text-sm text-grey" for="public">Public</label>
                    <a
                        target="_blank"
                        rel="nofollow noopener"
                        href="https://help.github.com/articles/about-gists/"
                        class="mx-2 py-1 text-sm text-blue hover:text-purple no-underline">What's this?</a>
                </div>
            </div>
            <div class="w-full relative flex flex-1">
                <div id="editor" class="w-full flex-1 py-1 font-mono leading-tight border-grey-light z-10 bg-transparent">
                </div>

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
            'gistId',
            'placeholder',
            'srcDemo',
            'srcDemo2',
            'srcSelf',
            'srcAbout'
        ],
        data: function () {
            return {
                editorId: 'editor',
                editor: Object,
                source: '',
                gistIsSaving: false,
                gistHtmlUrl: '',
            };
        },
        created () {
            // Load a gist, if the user came from gist.github.com:
            if (this.gistId == '') {
                return;
            }
            let apiGistUrl = 'https://api.github.com/gists/' + this.gistId;

            axios({
                method: 'GET',
                url: apiGistUrl,
                headers: {'Accept': 'application/vnd.github.v3+json'},
            })
            .then(function (response) {
                if (response.status === 200) {
                    let files = response.data.files;
                    let firstFile = Object.keys(files)[0];

                    let rawGistUrl = files[firstFile].raw_url;
                    app.$refs.twf.loadFromGist(rawGistUrl);
                } else {
                    console.log(response);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        methods: {
            clear: function () {
                this.editor.setValue('', 1);
            },
            center: function () {
                this.editor.selectAll();
                this.editor.indent();

                let newSource = '<div class="h-full flex justify-center items-center">\n' + this.source + '\n</div>';
                this.loadSource(newSource, 1, 4);
            },
            toggleGistPanel: function () {
                let panel = this.$refs.gistPanel;
                if (panel.classList.contains('hidden')) {
                    panel.classList.replace('hidden', 'inline-flex');
                    if (this.$refs.gistSaveButton) {
                        this.$refs.gistSaveButton.focus();
                    };
                } else {
                    panel.classList.replace('inline-flex', 'hidden');
                }
            },
            saveToGist: function () {
                let content = this.editor.getValue();
                if (content.length < 10) {
                    console.log("C'mon... that's probably not worth saving bruh.");
                    return;
                }
                if (this.gistIsSaving) {
                    return;
                }
                this.gistIsSaving = true;

                let menuItem = this.$refs.gistMenuItem;
                menuItem.classList.add('cursor-not-allowed');

                let descriptionFooter = '\n\n - created with https://tailwind.unravel.eu';

                let filename = kebabCase((this.$refs.gistFilename.value || 'Tailwind Fiddle') + '.html');
                let description = (this.$refs.gistDescription.value || 'Tailwind Fiddle') + descriptionFooter;
                let isPublic = this.$refs.gistIsPublic.checked;

                let payload = {
                    "description": description,
                    "public": isPublic,
                    "files": {
                        [filename]: {
                            "content": content
                        }
                    }
                };
                // console.log(payload);

                axios({
                    method: 'POST',
                    url: 'https://api.github.com/gists',
                    headers: {'Accept': 'application/vnd.github.v3+json'},
                    data: payload
                })
                .then(function (response) {
                    if (response.status === 201) {
                        app.$refs.twf.gistHtmlUrl = response.data.html_url;
                    } else {
                        console.log(response);
                    }
                    menuItem.classList.remove('cursor-not-allowed');
                    this.gistIsSaving = false;
                })
                .catch(function (error) {
                    console.log(error);
                    menuItem.classList.remove('cursor-not-allowed');
                    this.gistIsSaving = false;
                });
            },
            loadFromGist: function (rawGistUrl) {
                axios({
                    method: 'GET',
                    url: rawGistUrl,
                    headers: {'Accept': 'application/vnd.github.v3+json'},
                })
                .then(function (response) {
                    console.log(response);
                    if (response.status === 200) {
                        app.$refs.twf.loadSource(response.data);
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            clearGist: function () {
                this.gistHtmlUrl = '';
            },
            loadSource: function (source, cursorLineNo = 0, cursorColumnNo = 0) {
                this.editor.setValue(source, 1);
                this.editor.scrollToLine(0);

                this.editor.moveCursorTo(cursorLineNo, cursorColumnNo);
                this.editor.focus();
            }
        },
        mounted () {
            window.ace.require("ace/ext/language_tools");
            this.editor = window.ace.edit(this.editorId);
            this.editor.setTheme(`ace/theme/tomorrow`);
            // this.editor.style.fontSize='12px'; // Doesn't seem to work.

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

            window.ace.require("ace/ext/language_tools");
            this.editor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: false
            });
            editor.$blockScrolling = Infinity;

            // Hooking this up last, after editor is configured.
            this.editor.on('change', () => {
                this.source = this.editor.getValue();
            });

            let visitedAlready = localStorage.getItem('introSeen');
            if (visitedAlready == null) {
                this.loadSource(this.placeholder);
                localStorage.setItem('introSeen', true);
            }

        } // --- methods
    }
</script>
