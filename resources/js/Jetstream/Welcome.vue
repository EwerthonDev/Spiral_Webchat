<template class="bg-gray-900">
    <div>
        <div class="p-6 sm:px-20 bg-gray-700 border-b border-gray-700">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl text-white">
                Bem Vindo ao Spiral Webchat!
            </div>

            <div class="mt-6 text-gray-200">
                Spiral Webchat é um sistema de webchat criado com objetivos acadêmicos!
                Puramente voltado ao aprendizado das técnologias aqui utilizadas, são elas: <br><br>
                <ul>
                    <li>Laravel 8</li>
                    <li>Laravel Websockets</li>
                    <li>Laravel Echo</li>
                    <li>Vue.js</li>
                    <li>Vuex</li>
                    <li>Vuex-Persistedstate</li>
                </ul>
            </div>
        </div>

        <div class="bg-gray-600 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <img class="block h-9 w-auto" height="100px" width="100px" src="https://www.flaticon.com/svg/static/icons/svg/137/137099.svg"></img>
                    <div class="ml-4 text-lg text-gray-100 leading-7 font-semibold"><a href="/chat">Vá para o chat!</a></div>
                </div>

                <div class="ml-12">
                    <a href="/chat">
                        <div class="mt-3 flex items-center text-sm font-semibold text-green-500">
                                <div>Divirta-se no chat!</div>

                                <div class="ml-1 text-green-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </a>
                </div>
            </div>

            
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
