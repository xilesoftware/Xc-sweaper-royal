<template>
    <div>
        <component :is="layout">
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </component>
    </div>
</template>

<script>
const default_layout = "default";

export default {
    name: 'base-template',

    components: {
        'default-layout': () => import("./Default.vue")
    },
    
    props: {
        // 
    },

    computed: {
        layout() {
            return (this.$route.meta.layout || default_layout) + '-layout';
        }
    },

    mounted() {
        // 
    }
};
</script>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .1s ease;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>
