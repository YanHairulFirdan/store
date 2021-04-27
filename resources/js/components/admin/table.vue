<template>
    <table class="table">
        <thead>
            <tr>
                <td>no</td>
                <td>
                    invoices
                </td>
                <td>
                    Customer name
                </td>
                <td>
                    Customer address
                </td>
                <td>
                    Customer phone
                </td>
                <td>
                    district
                </td>
                <td>
                    Sub total
                </td>
                <td>Transaction date</td>
                <td>
                    Status
                </td>
                <td>
                    action
                </td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(transaction, index) in transactions" :key="index">
                <td>
                    {{ index+1 }}
                </td>
                <td>{{ transaction.invoices }}</td>
                <td>{{ transaction.customer_name }}</td>
                <td>{{ transaction.customer_phone }}</td>
                <td>{{ transaction.customer_address }}</td>
                <td>{{ transaction.customer_district }}</td>
                <td>{{ transaction.sub_total }}</td>
                <td>{{ transaction.transaction_date }}</td>
                <td>
                    <span class="mt-1 btn btn-sm btn-success" v-if="transaction.status">
                        {{ transaction.status }}
                    </span>
                    <span class="mt-1 btn btn-sm btn-secondary" v-else>
                        {{ transaction.status | statusFormat }}
                    </span>
                </td>
                <td>
                    <span class="btn btn-primary btn-sm ml-1">
                        confirm
                    </span>
                    <span class="btn btn-danger btn-sm ml-1">
                        delete
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                transactions: [
                    {
                        invoices: 'gdghshsdsjsu8923',
                        customer_name: 'Hanzo',
                        customer_phone: '763478947893488',
                        customer_address: 'gd fgdg fuifghf',
                        customer_district: 'yuduif fyufyu',
                        sub_total: '2256654',
                        transaction_date: '468696',
                        status: false
                    },
                    {
                        invoices: 'gdghshsdsjsu8923',
                        customer_name: 'Hanzo',
                        customer_phone: '763478947893488',
                        customer_address: 'gd fgdg fuifghf',
                        customer_district: 'yuduif fyufyu',
                        sub_total: '2256654',
                        transaction_date: '468696',
                        status: true
                    },
                    {
                        invoices: 'gdghshsdsjsu8923',
                        customer_name: 'Hanzo',
                        customer_phone: '763478947893488',
                        customer_address: 'gd fgdg fuifghf',
                        customer_district: 'yuduif fyufyu',
                        sub_total: '2256654',
                        transaction_date: '468696',
                        status: true
                    },
                    {
                        invoices: 'gdghshsdsjsu8923',
                        customer_name: 'Hanzo',
                        customer_phone: '763478947893488',
                        customer_address: 'gd fgdg fuifghf',
                        customer_district: 'yuduif fyufyu',
                        sub_total: '2256654',
                        transaction_date: '468696',
                        status: false
                    },
                    {
                        invoices: 'gdghshsdsjsu8923',
                        customer_name: 'Hanzo',
                        customer_phone: '763478947893488',
                        customer_address: 'gd fgdg fuifghf',
                        customer_district: 'yuduif fyufyu',
                        sub_total: '2256654',
                        transaction_date: '468696',
                        status: true
                    },
                ]
            }
        },
        filters: {
            statusFormat: function (value) {
                return (value === true) ? 'confirmed' : 'not confirmed yet';
            }
        }
    }

</script>

<style scoped>

</style>