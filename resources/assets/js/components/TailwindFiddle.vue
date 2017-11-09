<template>
    <div class="flex flex-col">
        <div class="fiddle w-full flex-1 overflow-hidden overflow-y-scroll antialiased" v-html="source">
        </div>

        <div class="w-full flex flex-col items-center" style="height: 20rem;">
            <div class="w-full h-6 px-2 bg-grey-lighter inline-flex items-center">
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer tracking-wide uppercase" v-on:click="clear">
                    Clear
                </div>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <a class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer tracking-wide uppercase no-underline" href="https://tailwindcss.com/docs/what-is-tailwind/" target="_blank" rel="nofollow noopener">Docs</a>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer tracking-wide uppercase" v-on:click="loadDemoSource">
                    Demo
                </div>
                <div class="px-1 text-xs text-grey-dark">|</div>
                <div class="px-2 text-xs text-grey-dark hover:text-blue cursor-pointer tracking-wide uppercase" v-on:click="loadAboutSource">
                    About
                </div>
            </div>
            <div class="w-full relative flex flex-1">
                <textarea
                    class="w-full flex-1 py-1 font-mono text-xs border-grey-light leading-tight"
                    name="name" rows="8" cols="80"
                    v-model="source"
                    placeholder="Your awesome HTML with Tailwind CSS here - note you're already within the <body></body> tags.">
                </textarea>
                <div class="absolute pin-t pin-r z-2">
                    <div class="text-5xl m-4 font-bold text-grey-lighter">TailwindCSS fiddle</div>
                </div>
            </div>
            <div class="h-8 flex items-center">
                <div class="text-xs flex items-center">
                    <span>Made with</span>
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
            'srcDefault',
            'srcAbout'
        ],
        data: function () {
            return {
                source: ''
            }
        },
        methods: {
            clear: function () {
                this.source = ''
            },
            loadDemoSource: function () {
                this.source = this.srcDefault
            },
            loadAboutSource: function () {
                this.source = this.srcAbout
            }
        }
    }
</script>
