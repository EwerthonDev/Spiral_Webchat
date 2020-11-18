<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height: 400px; max-height: 400px;">
                    <!-- Listagem de Contatos -->
                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                        <ul>
                            <li 
                                v-for="contato in contatos" :key="contato.id"
                                @click="() => {CarregaMensagens(contato.id)}"
                                :class="(contatoAtivo && contatoAtivo.id == contato.id) ? 'bg-gray-200 bg-opacity-50' : ''"
                                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex items-center">
                                    {{ contato.name }}
                                    <span v-if="contato.notificacao" class="ml-2 w-2 h-2 bg-green-500 rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!-- Caixa de Mensagens -->
                    <div class="w-9/12 flex flex-col justify-between">
                        <!-- Mensagens -->
                        <div class="w-full p-6 flex flex-col overflow-y-scroll">
                            <div 
                                v-for="mensagem in mensagens" :key="mensagem.id"
                                :class="(mensagem.de == $page.auth.usuario.id) ? 'text-right' : ''"
                                class="w-full mb-3 mensagem">
                                <p 
                                    :class="(mensagem.de == $page.auth.usuario.id) ? 'minhaMensagem' : 'mensagemParaMim'"
                                    class="inline-block p-2 rounded-md" style="max-width: 75%;">
                                    {{ mensagem.conteudo }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">{{ mensagem.created_at | formatarData()}}</span>
                            </div>
                        </div>

                        <!-- Formulário -->
                        <div v-if="contatoAtivo" class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                            <form v-on:submit.prevent="enviarMensagem">
                                <div class="flex rounded-md overflow-hidden border border-gray-300">
                                    <input v-model="mensagem" type="text" class="flex-1 px-4 py-2 text-sm focus:outline-none">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2">Enviar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import Vue from 'vue'
    import AppLayout from '@/Layouts/AppLayout'
    import Store from '../store';

    export default {
        components: {
            AppLayout,
        },
        data () {
            return {
                contatos: [],
                mensagens: [],
                contatoAtivo: null,
                mensagem: ''
            }
        },
        computed: {
            contato() {
                return Store.state.contato
            }
        },
        methods: {
            scrollParaBaixo: function() 
            {

                if(this.mensagens.length) {
                    document.querySelectorAll('.mensagem:last-child')[0].scrollIntoView();
                }
            },
            CarregaMensagens: async function(contatoId)
            {   

                axios.get(`api/contatos/${contatoId}`).then(response => {
                    this.contatoAtivo = response.data.contato
                })

                await axios.get(`api/mensagens/${contatoId}`).then(response => {
                    this.mensagens = response.data.mensagens
                })

                const contato = this.contatos.filter((contato) => {
                        if (contato.id === contatoId) {
                            return contato
                        }
                })

                if (contato) {
                    Vue.set(contato[0], 'notificacao', false)
                }

                this.scrollParaBaixo()
                
            },
            enviarMensagem: async function() 
            {

                await axios.post(`api/mensagens/store`, {
                    'conteudo': this.mensagem,
                    'para': this.contatoAtivo.id
                }).then(response => {

                    this.mensagens.push({
                        'de': this.contato.id,
                        'para': this.contatoAtivo.id,
                        'conteudo': this.mensagem,
                        'created_at': new Date().toISOString(),
                        'updated_at': new Date().toISOString()
                    })

                    this.mensagem = '';
                }) 

                this.scrollParaBaixo()
            }

        },
        mounted () {
            axios.get('api/contatos').then(response => {
                this.contatos = response.data.contatos
            })

            Echo.private(`user.${this.contato.id}`).listen('.EnviarMensagem', async (e) => {
                if(this.contatoAtivo && this.contatoAtivo.id === e.mensagem.de) {
                    await this.mensagens.push(e.mensagem)
                    this.scrollParaBaixo
                } else {
                    const contato = this.contatos.filter((contato) => {
                        if (contato.id === e.mensagem.de) {
                            return contato
                        }
                    })

                    if (contato) {
                        Vue.set(contato[0], 'notificacao', true)
                    }
                }
            })
        }
    }
</script>

<style>
.minhaMensagem
{
    @apply bg-gray-300 bg-opacity-25;
}

.mensagemParaMim
{
    @apply bg-indigo-300 bg-opacity-25;
}
</style>