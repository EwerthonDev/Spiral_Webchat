import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        contato: {}
    },
    mutations: {
        setContatoState: (state, value) => state.contato = value
    },
    actions: {
        contatoStateAction: ({commit}) => {
            axios.get('api/contato/eu').then(response => {
                const usuarioResponse = response.data.usuarioLogado
                
                commit('setContatoState', usuarioResponse);
            })
        }
    },
    plugins: [createPersistedState()],
});