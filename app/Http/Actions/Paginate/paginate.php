<?php

namespace App\Http\Actions\Paginate;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class paginate
{
    protected $data;
    protected $request;
    public function __construct($data,$request){
        $this->data = $data;
        $this->request = $request;
    }

    public function  run(){
        $paginated_data = $this->paginatingArray($this->data,$this->request);
        return $this->getPaginatedData($paginated_data);
    }
    protected function paginatingArray($array_data,Request $request){
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // CreateOrUpdate a new Laravel collection from the array data
        $itemCollection = collect($array_data);

        // Define how many items we want to be visible in each page
        $perPage = 10   ;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->values();

        $currentPageItems = $currentPageItems->all();

        // CreateOrUpdate our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generated links
        $url_paths = $paginatedItems->setPath($request->url());
        return $paginatedItems;
    }

    protected function getPaginatedData($paginated_data){
        $last_page= $paginated_data->lastPage();
        return [
            'next_page_url' => $paginated_data->nextPageUrl(),
            'previous_page_url' => $paginated_data->previousPageUrl(),
            'first_page_url' => $paginated_data->url(1),
            'last_page_url' => $paginated_data->url($last_page),
            'total' => $paginated_data->total(),
            'last_page' => $paginated_data->lastPage(),
            'per_page'=>$paginated_data->perPage(),
            'data' => $paginated_data->items(),
        ];
    }
}
