import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/stores/auth'

const store = createStore({
    plugins:[
        createPersistedState({
            storage: window.sessionStorage,
        })
    ],
    modules:{
        auth
    }
})

export default store