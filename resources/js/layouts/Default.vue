<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" :to="{ name: 'lobby' }">
                    Play <font-awesome-icon icon="play" size="xs" :style="{ color: 'gray' }" />
                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user.username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <router-link class="dropdown-item" :to="{ name: 'settings' }">Settings</router-link>
                                <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>

                                <form id="logout-form" ref="logout" action="/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" :value="csrf" />
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <h1><b>X-SWEEPER ROYALE</b></h1>
                    <slot></slot>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data: () => ({
        // 
    }),

    computed: {
        csrf() {
            return document.querySelector('meta[name="csrf-token"]').content;
        },

        user() {
            return this.$store.state.user;
        }
    },

    created() {
        this.getUser();
    },

    methods: {
        getUser() {
            this.$store.dispatch('getUser');
        },

        logout() {
            this.$refs.logout.submit();
            // document.getElementById('logout-form').submit();

        }
    }
};
</script>

<style>
    /*  */
</style>
