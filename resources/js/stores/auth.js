import axios from "axios";
import router from "@/router";

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {},
        token: "",
        api: "http://127.0.0.1:8000/api",
        auth: {
            email: "",
            password: "",
        },
        test:'Fazle'
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },
        SET_USER(state, value) {
            state.user = value;
            //state.token = value.token;
        },
        SET_USERINFO(state, value) {
            state.user = value.user;
        },

        SET_AUTH(state, data) {
            state.auth.email = data.email;
            state.auth.password = data.password;
            console.log(data);
        },
        
    },
    actions: {

        setAuth({ commit, state}, payload) {
            commit('SET_AUTH', payload)
        },

        login({commit}){
            return axios.get('/api/user').then(({data})=>{
                commit('SET_USER',data)
                commit('SET_AUTHENTICATED',true)
                console.log(data);
                router.push({name:'Dash'})
            }).catch((response)=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        
        getUser({ commit, state }) {
            return axios
                .get(`${state.api}/user`, {
                    headers: { Authorization: `Bearer ${state.token}` },
                })
                .then(({ data }) => {
                    // console.log(data);
                })
                .catch(({ response: { data } }) => {
                    if (response.status === 422) {
                        state.validationErrors = response.data.data;
                    } else {
                        state.validationErrors = {};
                        commit("SET_USER", {});
                        commit("SET_AUTHENTICATED", false);
                        router.push({ name: "home" });
                    }
                });
        },

        // logout({ commit, state }) {
        //     return axios
        //         .post(`${state.api}/logout`, null, {
        //             headers: { Authorization: `Bearer ${state.token}` },
        //         })
        //         .then(({ data }) => {
        //             commit("SET_USER", {});
        //             commit("SET_AUTHENTICATED", false);
        //             router.push({ name: "home" });
        //         })
        //         .catch(({ response: { data } }) => {
        //             if (response.status === 422) {
        //                 state.validationErrors = response.data.data;
        //             } else {
        //                 state.validationErrors = {};
        //                 commit("SET_USER", {});
        //                 commit("SET_AUTHENTICATED", false);
        //                 router.push({ name: "home" });
        //             }
        //         });
        // },

        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
        }
    },
};
