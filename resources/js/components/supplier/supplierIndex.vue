<template>
<div class="table-responsive-lg">
        <table class="table" id="sp-tb">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Tel</th>
                    <th>E-mail</th>
                    <th>Address</th>
                </tr>
            </thead>
        </table>
</div>
</template>

<script>
    import $ from 'jquery'
    import 'datatables.net-bs4'

    export default {
         props: {
            url: {
                type: String,
                default: null
            },
        },
        mounted() {
            $('#sp-tb').DataTable({
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5 d-inline-flex'i><'col-sm-12 col-md-7'p>>",
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: this.url,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'tel', name: 'tel'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'}
                ]
            });
        }
    };
</script>
