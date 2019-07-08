<script>
    import Vue from 'vue';
    import Vuex from 'vuex';
    import axios from 'axios';

    Vue.use(Vuex);
    const store = new Vuex.Store({
        state: {
            brands:[],
            meta_keys:[],
            users: [],
            roles: [],
            products: [],
            blogs: [],
            countProduct: '',
            countBlog: '',
        },
        mutations: {
            FETCH_USER(state, payload) {
                state.users = payload;
            },
            ADD_USER(state, payload) {
                state.users = [payload, ...state.users];
            },
            USER_ROLE(state, payload) {
                state.roles = payload;

            },
            FETCH_PRODUCT(state, payload) {
                state.products = payload
            },
            FETCH_BLOG(state, payload) {
                state.blogs = payload
            },
            COUNT_BLOG(state, payload) {
                state.countBlog = payload;
            },
            COUNT_PRODUCT(state, payload) {
                state.countProduct = payload
            },
            FETCH_BRANDS(state,payload){
                state.brands=payload;
            },
            FETCH_PRODUCT_META_KEYS(state,payload){
                state.meta_keys=payload;
            }
        },
        actions: {
            fetchUser(context) {
                axios.get('api/v1/user')
                    .then((res) => {
                        context.commit("FETCH_USER", res.data.data);
                    }).catch(err => {
                    console.log(err);
                })
            },
            fetchUserRole(context) {
                axios.get('api/v1/user/role')
                    .then(res => {
                        context.commit('USER_ROLE', res.data)
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            fetchProducts(context) {
                let page =1;
                axios.get('api/v1/product?page='+page)
                    .then(res => {
                        context.commit('FETCH_PRODUCT', res.data.data);
                        page ++;
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            fetchBlog(context) {
                axios.get('api/v1/blogs')
                    .then(res => {
                        context.commit('FETCH_BLOG', res.data.data)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            countBlog({commit}) {
                axios.get('api/v1/blog/count')
                    .then(res => {
                        commit('COUNT_BLOG', res.data)
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            countProduct({commit}) {
                axios.get('api/v1/product/count')
                    .then(res => {
                        commit('COUNT_PRODUCT', res.data)
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            selectBrand({commit}) {
                axios.get('api/v1/brands')
                    .then(res => {
                        commit('FETCH_BRANDS', res.data);

                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            selectMetaKey({commit}) {
                axios.get('api/v1/meta_keys')
                    .then(res => {
                        commit('FETCH_PRODUCT_META_KEYS', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
        }
    });
    export default store;

</script>
