<template>
    <div class="table-responsive-lg">
        <table class="table table-striped position-relative" id="dataTable">
            <thead class="bg-success text-white">
                <tr>
                    <th v-for="(title, index) in columnsTitle" :key="index">{{ title }}</th>
                </tr>
            </thead>
            <tfoot class="bg-success text-white">
                <tr>
                    <th v-for="(title, index) in columnsTitle" :key="index">{{ title }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import $ from 'jquery'
    import 'datatables.net-bs4'

    export default {
        props: {
            columnsTitle: {
                type: Array,
                default: null,
                required: true
            },
            tableConfig: {
                type: Object,
                default: null,
                required: true
            }
        },
        mounted() {
            $('#dataTable').DataTable(this.tableConfig)
        }
    };

</script>

<style scoped>
.table {
    font-size: 10pt;
}
</style>
