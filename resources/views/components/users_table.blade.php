<div class="users-table-area default-flex">
    <table class="users-table">
        <thead class="users-table-head">
            <tr>
                <th scope="col"></th>
                <th scope="col">Nome</th>
                <th scope="col">Usuário</th>
                <th scope="col">Perfil</th>
                <th scope="col">Acesso</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody class = "users-table-body">
            {{$slot}}
        </tbody>
    </table>
</div>
