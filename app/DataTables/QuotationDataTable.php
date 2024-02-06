<?php

namespace App\DataTables;

use App\Models\Quotation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuotationDataTable extends DataTable
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
                return view('projects.suppliers.quotations.actions', ['query' => $query])->render();
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Quotation $model): QueryBuilder
    {
        return $model->newQuery()->where('project_supplier_id', request()->route('supplier'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('quoatation-table')
                    ->setTableHeadClass('bg-gray-200')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'ASC')
                    ->selectStyleSingle()
                    ->language([
                        "searchPlaceholder" => "Search...",
                        "lengthMenu" => "Per page _MENU_",
                    ])
                    ->buttons(
                        Button::make('reload')
                        ->text('<i class="bi bi-arrow-repeat"></i> Reload'),
                    );
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
                  ->width(120)
                  ->addClass('relative text-left py-2'),
            Column::make('id'),
            Column::make('quotation_reference'),
            Column::make('amount'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Quoatation_' . date('YmdHis');
    }
}
