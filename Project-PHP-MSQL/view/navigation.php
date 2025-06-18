<?php
function createPagination(int $totalRecords, int $recordsPerPage, int $currentPage, string $pageUrl, int $maxLinks = 10)
{
    $totalPages = (int) ceil($totalRecords / $recordsPerPage);

    $html = '<nav aria-label="Page navigation example">';
    $html .= '<ul class="pagination justify-content-center">';

    $disabled = $currentPage === 1 ? ' disabled' : '';
    $previousPage = max(($currentPage - 1), 1);
    $html .= '<li class="page-item' . $disabled . '">
            <a href="' . $pageUrl . '&page=' . $previousPage . '" class="page-link">Previous</a>
        </li>';

    $startPage = (int) max(1, $currentPage - floor($maxLinks / 2));
    $endPage = min(($startPage + $maxLinks), $totalPages);

    if (($endPage - $startPage + 1) < $maxLinks) {
        $startPage = max(1, ($endPage - $maxLinks + 1));
    }

    for ($i = $startPage; $i <= $totalPages; $i++) {
        if ($i === $currentPage) {
            $html .= '<li class="page-item active" aria-current="page">
                        <span class="page-link">' . $i . '</span>
                      </li>';
        } else {
            $html .= '<li class="page-item">
                        <a class="page-link" href="' . $pageUrl . '&page=' . $i . '">' . $i . '</a>
                      </li>';
        }
    }

    $disabled = $currentPage === $totalPages ? ' disabled' : '';
    $next = (int) min(($currentPage + 1), $totalPages);
    $html .= '<li class="page-item' . $disabled . '">
            <a href="' . $pageUrl . '&page=' . $next . '" class="page-link">Next</a>
        </li>';
    $html .= '</ul></nav>';

    return $html;
}
