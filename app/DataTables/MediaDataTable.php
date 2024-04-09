<?php

namespace App\DataTables;

use App\Models\Media;
use App\Models\Medium;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MediaDataTable extends DataTable
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
                return view('admin.media.actions', ['query' => $query])->render();
            })
            ->addColumn('image', function($query){
                return "<img src=". $query->url ." class='w-12'>";
            })
            ->rawColumns(['action','image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Media $model): QueryBuilder
    {
        return $model->newQuery()->where('title', '!=', null);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('media-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
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
            Column::make('image')
                ->width(150),
            Column::make('url'),
            Column::make('title'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Media_' . date('YmdHis');
    }
}
