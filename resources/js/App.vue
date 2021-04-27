<template>
    <div class="w-100">
        <div class="row justify-content-center">
            <div class="col-12 p-0">
                <app-header></app-header>
            </div>
        </div>
        <main class="d-flex p-0">
            <app-sidebar></app-sidebar>
            <app-main class="content"></app-main>
        </main>
    </div>
</template>

<script>
    import header from './admin/header.vue';
    import sidebar from './admin/sidebar.vue';
    import main from './admin/main.vue';
    export default {
        components: {
            'app-header': header,
            'app-sidebar': sidebar,
            'app-main': main,
        },
        data() {
            return {

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    .d-flex {
        padding: 0% !important;
        margin: 0% !important;
    }
</style>