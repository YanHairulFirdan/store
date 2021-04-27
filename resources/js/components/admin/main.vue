<template>
    <main class=" p-2 container-fluid">
        <div class="title-wrapper ml-5 mb-2 mt-2">
            <h3 class="">
                Rangkuman Pendapatan bulan ini
            </h3>
        </div>
        <div class="mt-4 row p-3 wrap">
            <!-- <div class="" > -->
            <div class="my-1 card col-md-3 col-sm-6 col-12" v-for="data in dasboardData">
                <div class="card-header">
                    <h4 class="card-title">{{ data.name }}</h4>
                </div>
                <div class="card-body"><span>
                        <span v-if="data.name == 'profit'">
                            {{ data.amount }}
                        </span>
                        <span v-else>
                            {{ data.amount }}
                        </span>
                    </span></div>
            </div>
            <!-- </div> -->
        </div>
        <app-table></app-table>
    </main>
</template>

<script>
    import table from './table.vue';
    export default {
        components: {
            'app-table': table,
        },
        data() {
            return {
                dasboardData: [
                    {
                        name: 'Sale',
                        amount: 1000
                    },
                    {
                        name: 'Profit',
                        amount: "3000000",
                    },
                    {
                        name: 'Transaction',
                        amount: 10000
                    },
                    {
                        name: 'User',
                        amount: 100
                    },

                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        filters: {
            currency: function (value) {
                return new Intl.NumberFormat('ID').format(value);
            }
        }
    }
</script>

<style scoped>
    main {
        /* width: 70%; */
        /* width: auto;
         */
        flex-basis: auto;

        /* flex-grow: 1; */
    }

    .card {
        max-height: fit-content;
        width: 12em;
    }
</style>