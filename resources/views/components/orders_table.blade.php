<main class="dashboard-main-area">
    <div class="order-filter-area default-flex">
        <div class="status-filter default-flex">
            <p class="status-filter-item status-filter-item-active " id="status-filter-item">Todos</p>
            <p class="status-filter-item" id="status-filter-item">Não Processados</p>
            <p class="status-filter-item" id="status-filter-item">Processados</p>
            <p class="status-filter-item" id="status-filter-item">Pendentes</p>
            <p class="status-filter-item" id="status-filter-item">Cancelados</p>
        </div>

        <div class="split-bar"></div>

        <div class="location-filter default-flex">
            <i class='bx bxs-map'></i>

            <select type="select" name="location-filter-select" id="city-filter-item">
                <option value="default" selected>Todos os Locais</option>
                {{$filterOption}}
            </select>
        </div>
    </div>

    <div class="orders-table-area default-flex">
        <table class="orders-table">
            <thead>
                <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Status do Pagamento</th>
                    <th scope="col">Status do Processamento</th>
                </tr>
            </thead>

            <tbody class = "orders-table-body">
                {{$slot}}
            </tbody>
        </table>
    </div>
</main>
