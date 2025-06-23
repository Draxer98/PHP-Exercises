<div class="col-sm-2">
    <form class="d-inline-flex ms-2 " method="GET" role="search" name="searchForm" id="searchForm">
        <div class="col-auto">
            <label class="form-label mb-0 me-1" for="orderBy"><small>Order by:</small></label>
            <select class="form-select form-select-sm" name="orderBy" onchange="this.form.submit()">
                <?php
                foreach ($orderByColumns as $col) {
                    $selected = $col === $orderBy ? 'selected' : '';
                    echo "<option $selected value=\"$col\">" . strtoupper($col) . "</option>\n";
                }
                ?>
            </select>
        </div>
        <div class="col-auto">
            <label class="form-label mb-0 me-1" for="orderDir"><small>Dir:</small></label>
            <select class="form-select form-select-sm" name="orderDir" onchange="this.form.submit()">
                <option value="ASC" <?= $currentOrderDir === 'ASC' ? 'selected' : '' ?>>ASC</option>
                <option value="DESC" <?= $currentOrderDir === 'DESC' ? 'selected' : '' ?>>DESC</option>
            </select>
        </div>
        <div class="col-auto">
            <label class="form-label mb-0 me-1" for="recordsPerPage"><small>View:</small></label>
            <select class="form-select form-select-sm" name="recordsPerPage" onchange="this.form.submit()">
                <?php
                foreach ($recordsPerPageOptions as $v) {
                    $selected = $v == $recordsPerPage ? 'selected' : '';
                    echo "<option $selected value=\"$v\">$v</option>\n";
                }
                ?>
            </select>
        </div>
    </form>
</div>