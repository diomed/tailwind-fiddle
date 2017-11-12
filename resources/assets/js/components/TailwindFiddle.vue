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
                <!-- v-on:keydown.tab.prevent="keydownTab" -->
                <!-- v-on:keydown.shift.tab.prevent="keydownShiftTab" -->
                <!-- v-on:keydown.enter.prevent="keydownEnter" -->
                <textarea
                    ref="editor"
                    class="language-html w-full flex-1 py-1 font-mono text-xs border-grey-light leading-tight z-10 bg-transparent"
                    name="name" rows="8" cols="80"
                    v-model="source"
                    v-on:keydown.delete.prevent="keydownDelete"
                    placeholder="Your awesome HTML with Tailwind CSS goes here. Hit Demo or About above to see what's this about 💡">
                </textarea>
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
            'srcDemo',
            'srcSelf',
            'srcAbout'
        ],
        data: function () {
            return {
                source: ''
            }
        },
        methods: {
            clear: function () {
                this.source = '';
            },
            loadSource: function (source) {
                this.source = source;
            },
            keydownEnter: function () {
                let editor = this.$refs.editor;
                let selectionStart = editor.selectionStart;
                let selectionEnd   = editor.selectionEnd;

                let newSelectionStart = 0;
                let newSelectionEnd   = 0;

                let first  = this.source.substring(0, selectionStart);
                let second = this.source.substring(selectionEnd);

                if (selectionStart === selectionEnd) {
                    let lastNewline = this.source.lastIndexOf('\n', selectionEnd - 1);

                    let restOfSource = '';
                    let cursorPositionDelta = 1;

                    if (lastNewline === -1) {
                        this.source = first + '\n' + second;
                    } else {
                        restOfSource = this.source.substring(lastNewline + 1, this.source.length);

                        let whitespaceRegEx = /^\s*/gi;
                        let whitespaceMatch = restOfSource.match(whitespaceRegEx)[0];

                        this.source = first + '\n' + whitespaceMatch + second;
                        cursorPositionDelta = whitespaceMatch.length + 1;
                    }

                    newSelectionStart = selectionEnd + cursorPositionDelta;
                    newSelectionEnd   = newSelectionStart;
                } else {
                    this.source = first + '\n' + second;

                    newSelectionStart = selectionEnd - 1;
                    newSelectionEnd   = newSelectionStart;
                }

                Vue.nextTick(function () {
                    editor.setSelectionRange(newSelectionStart, newSelectionEnd);
                });
            }, // --- enter
            keydownDelete: function () {
                let editor = this.$refs.editor;
                let selectionStart = editor.selectionStart;
                let selectionEnd   = editor.selectionEnd;

                let newSelectionStart = 0;
                let newSelectionEnd = 0;

                if (selectionStart === selectionEnd) {
                    if (selectionStart > 0) {
                        let first  = this.source.substring(0, selectionStart - 1);
                        let second = this.source.substring(selectionStart);

                        this.source = first + second;

                        newSelectionStart = selectionStart - 1;
                        newSelectionEnd   = selectionStart - 1;
                    }
                } else {
                    let first  = this.source.substring(0, selectionStart);
                    let second = this.source.substring(selectionEnd);

                    this.source = first + second;

                    newSelectionStart = selectionStart;
                    newSelectionEnd   = selectionStart;
                }

                Vue.nextTick(function () {
                    editor.setSelectionRange(newSelectionStart, newSelectionEnd);
                });
            }, // --- delete
            keydownTab: function () {
                let text = '    '; // TODO extract
                let editor = this.$refs.editor;
                let selectionStart = editor.selectionStart;
                let selectionEnd = editor.selectionEnd;

                let first = this.source.substring(0, editor.selectionEnd);
                let second = this.source.substring(editor.selectionEnd);

                if (selectionStart === selectionEnd) {
                    this.source = first + text + second;
                } else {
                    // Indent selected lines.
                    let lastNewlineIndex = this.source.lastIndexOf('\n', selectionStart - 1);
                    let newlineIndex = 0, searchToIndex = selectionEnd;
                    do {
                        newlineIndex = this.source.lastIndexOf('\n', searchToIndex - 1);

                        let first  = this.source.substring(0, newlineIndex + 1);
                        let second = this.source.substring(newlineIndex + 1);

                        this.source = first + text + second;
                        searchToIndex = newlineIndex;
                    } while (newlineIndex > lastNewlineIndex);
                }

                let textLength = text.length;
                Vue.nextTick(function () {
                    editor.setSelectionRange(selectionStart + textLength, selectionEnd + textLength);
                });
            }, // --- tab
            keydownShiftTab: function () {
                let text = '    '; // TODO extract
                let editor = this.$refs.editor;
                let selectionStart = editor.selectionStart;
                let selectionEnd = editor.selectionEnd;

                let newSelectionStart = 0;
                let newSelectionEnd = 0;

                // let first = this.source.substring(0, editor.selectionEnd);
                // let second = this.source.substring(editor.selectionEnd);

                if (selectionStart === selectionEnd && selectionStart >= text.length) {
                    if (this.source.substring(selectionStart - text.length, selectionStart) !== text) {
                        // TODO de-indent
                        return;
                    } else {
                        let first = this.source.substring(0, selectionStart - text.length)
                        let second = this.source.substring(selectionStart);
                        this.source = first + second;

                        newSelectionStart = selectionStart - 4;
                        newSelectionEnd = newSelectionStart;
                    }
                } else {
                    //  TODO De-indent selected lines.
                }

                Vue.nextTick(function () {
                    editor.setSelectionRange(newSelectionStart, newSelectionEnd);
                });
            }

        } // --- methods
    }
</script>
