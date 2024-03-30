<?php

namespace App\DataTables;

use App\Models\Bu;
use App\Models\Bus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BusDataTable extends DataTable
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
                return '<a id="actionsDropdownBtn" href="'. route('buses.show', $query->id) .'" class="actionsDropdownBtn" type="button">view bus</a>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Bus $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bus-table')
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
                ->width(120)
                ->addClass('relative text-left py-2'),
            Column::make('bus_name'),
            Column::make('subtext'),
            Column::make('total_seats'),
            Column::make('badge'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Bus_' . date('YmdHis');
    }
}
