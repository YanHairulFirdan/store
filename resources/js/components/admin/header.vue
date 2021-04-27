<template>
    <header class="shadow container-fluid bg-primary py-3">
        <div class="row d-flex flex-row justify-content-between no-wrap text-light">
            <div class="col-2">
                <span class="text-center nav-link font-weight-bold">Logo</span>
            </div>
            <div class="col-2">
                <span class="text-center nav-link font-weight-bold">User</span>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        data() {
            return {
                show: false
            }
        }
    }
</script>

<style scoped>
    header {
        box-shadow: 12px 10px 13px #000;
    }
</style>