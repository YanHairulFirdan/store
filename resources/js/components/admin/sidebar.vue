<template>
    <aside class="shadow-lg bg-primary text-light" :class="{show:show}">
        <div class="toggle pr-2">
            <span class="pl-2 font-weight-bold" @click="show=!show">
                &#8592
            </span>
            <!-- <span v-show="!show" class="pl-2 font-weight-bold" @click="show=!show">
                &#8594
            </span> -->
        </div>
        <div class="menu border-bottom-1 py-2" v-for="menu in menus">
            <span class="font-weight-bold  p-2">
                {{ menu }}
            </span>
        </div>
    </aside>
</template>

<script>
    export default {
        components: {

        },
        data() {
            return {
                show: true,
                menus: [
                    "dashboard",
                    "book",
                    "categories",
                    "transactions",
                    "user",
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    aside {
        height: 100em;
        flex-basis: 4%;
        transition: all 1s ease-in-out;
    }

    /* .show .menu {
        display: none;
    } */

    .show {
        flex-basis: 25%;
    }

    .show>.menu {
        display: block;
    }

    aside>.menu {
        display: none;
        transition: all .5s ease-in-out;
    }


    .toggle:hover {
        cursor: pointer;
    }

    .menu {
        text-transform: capitalize;
        border-bottom: .1px solid #fff;
    }

    .menu:hover {
        background-color: #fff;
        color: var(--primary);
    }
</style>