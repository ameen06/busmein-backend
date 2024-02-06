<?php

namespace App\DataTables;

use App\Models\ProjectSupplier;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProjectSupplierDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                // returning actions-dropdown component
                return view('projects.suppliers.actions', ['query' => $query])->render();
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProjectSupplier $model): QueryBuilder
    {
        return $model->newQuery()
                        ->with(['project','supplier'])
                        ->withSum('quotations', 'amount')
                        ->where('project_id', request()->route('project'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('supplier-table')
                    ->setTableHeadClass('bg-gray-200')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel')   
                            ->text('<i class="bi bi-file-spreadsheet"></i> Export Excel'),
                        Button::make('csv')
                            ->text('<i class="bi bi-filetype-csv"></i> Export CSV'),
                        Button::make('pdf')
                            ->text('<i class="bi bi-file-pdf"></i> Export PDF'),
                        Button::make('print')
                            ->text('<i class="bi bi-printer"></i> Print'),
                        Button::make('reload')
                            ->text('<i class="bi bi-arrow-repeat"></i> Reload'),
                    ])
                    ->language([
                        "searchPlaceholder" => "Search...",
                        "lengthMenu" => "Per page _MENU_",
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('relative text-left py-2'),
            Column::make('work_name'),
            Column::make('supplier.full_name')->title('Supplier Name'),
            Column::make('quotations_sum_amount')->title('Total Amount'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProjectSupplier_' . date('YmdHis');
    }
}
