<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC Financial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>


<body>
    <div id="app">
        <h1 class="text-center p-3">@{{ message }}</h1>

        <div class="container table responsive">
            <div v-if="loading" class="loader" style="width:100%; height:100%;">
                <center>
                    <img src="https://i.gifer.com/ZKZg.gif">
                    <p>Cargando datos, por favor espera...</p>
                </center>
            </div>

            <table class="table table-bordered table-striped" id="members_table">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Fecha de Nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, index) in members" :key="index">
                        <td>@{{ member.memberId }}</td>
                        <td>@{{ member.personal.firstName }} @{{ member.personal.lastName }}</td>
                        <td>@{{ member.personal.email }}</td>
                        <td>@{{ member.personal.addressLine1 }}</td>
                        <td>@{{ member.personal.city }}</td>
                        <td>@{{ member.personal.birthDate }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
const { createApp } = Vue;
createApp({
    data() {
        return {
            message: 'Members List',
            members: [],
            loading : true
        }
    },
    mounted() {
        fetch('{{ url('/api/members') }}')
        .then(response => response.json())
        .then(data => {
            this.members = data.members;
            console.log(data);

            this.$nextTick(() => {
                $('#members_table').DataTable();  // Inicializar DataTables en la tabla
            });
            this.loading = false;
        })
        .catch(error => {
            console.error('Error:', error);
            this.loading = false;
        });
    }
}).mount('#app');
</script>


</body>
</html>