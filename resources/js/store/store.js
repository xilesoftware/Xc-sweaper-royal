import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: {}
    },

    mutations: {
        setUser(state, payload) {
            state.user = payload;
        }
    },

    actions: {
        getUser: async (context) => {
            let { data } = await axios.get('/api/user');
            context.commit("setUser", data);
        }
    },

    getters: {
        // 
    }
});

export default store;