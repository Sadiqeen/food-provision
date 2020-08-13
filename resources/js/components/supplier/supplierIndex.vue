<template>
    <div class="table-responsive-lg position-relative">
        <div class="loading">
            <div class="spinner-grow text-danger" style="width: 5rem; height: 5rem;" role="status">
            <span class="sr-only">Loading...</span>
            </div>
        </div>
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
        name:"suppierIndex",
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
            // $('#dataTable').DataTable()
            $('#dataTable').on( 'processing.dt', function ( e, settings, processing ) {
                if (processing) {
                    $('.loading').css( 'display', 'flex' );
                } else {
                    $('.loading').css( 'display', 'none' );
                }
            } )
            .dataTable(this.tableConfig);
        }
    };

</script>

<style scoped>
.table {
    font-size: 10pt;
}
.loading {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.2);
    z-index: 10;
}
</style>
