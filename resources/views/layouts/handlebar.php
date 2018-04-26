<script id="details-mobil-template" type="text/x-handlebars-template">
    <div class="label label-info">Mobil {{ name }}'s</div>
        <table class="table details-table" id="mobil-{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Deposit</th>
            </tr>
            </thead>
    </table>
</script>

<script id="details-transaksi-template" type="text/x-handlebars-template">
    <div class="label label-info">Transaksi <b>{{ no_transaksi }}</b></div>
        <table class="table details-table" id="transaksi-{{id}}">
            <thead>
            <tr>
                <th>Driver</th>
                <th>Mobil</th>
                <th>Warna</th>
                <th>No Plat</th>
                <th>No Telp</th>
            </tr>
            </thead>
    </table>
</script>