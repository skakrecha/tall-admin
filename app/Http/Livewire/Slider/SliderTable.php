<?php

namespace App\Http\Livewire\Slider;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Slider;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class SliderTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "slider_id";

    public function destroySelected()
    {
        Slider::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Sliders Deleted Successfully", "type"=>"success"]);
    }

    public function columns(): array
    {
        if ($this->page > 1) {
            $this->index = ($this->page - 1) * $this->perPage;
        } else {
            $this->index = 0;
        }

        return [
            Column::make(__('No.'))->format(function () {
                return ++$this->index;
            }),

            Column::make('Title', 'slider_title')
    ->searchable()
    ->sortable(),
Column::make('Desc', 'slider_desc')
    ->searchable()
    ->sortable(),
Column::make('Image', 'slider_image')
    ->searchable()
    ->sortable(),
Column::make('Status', 'slider_active')
    ->searchable()
    ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Slider $row) {
                    return view('livewire.slider._slider-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
       return Slider::query();
    }
}
