<?php
#app/Http/Admin/Controllers/ReportController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopAttributeGroup;
use App\Models\ShopLanguage;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $languages, $types, $kinds, $virtuals, $attributeGroup;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();
        $this->attributeGroup = ShopAttributeGroup::getList();
        $this->types = [
            SC_PRODUCT_NORMAL => trans('product.types.normal'),
            SC_PRODUCT_NEW => trans('product.types.new'),
            SC_PRODUCT_HOT => trans('product.types.hot'),
        ];
        $this->kinds = [
            SC_PRODUCT_SINGLE => trans('product.kinds.single'),
            SC_PRODUCT_BUILD => trans('product.kinds.build'),
            SC_PRODUCT_GROUP => trans('product.kinds.group'),
        ];
        $this->virtuals = [
            SC_VIRTUAL_PHYSICAL => trans('product.virtuals.physical'),
            SC_VIRTUAL_DOWNLOAD => trans('product.virtuals.download'),
            SC_VIRTUAL_ONLY_VIEW => trans('product.virtuals.only_view'),
            SC_VIRTUAL_SERVICE => trans('product.virtuals.service'),
        ];

    }

    public function product()
    {
        $data = [
            'title' => trans('product.admin.list'),
            'sub_title' => '',
            'icon' => 'fa fa-indent',
            'menu_left' => '',
            'menu_right' => '',
            'menu_sort' => '',
            'script_sort' => '',
            'menu_search' => '',
            'script_search' => '',
            'listTh' => '',
            'dataTr' => '',
            'pagination' => '',
            'result_items' => '',
            'url_delete_item' => '',
        ];

        $listTh = [
            'id' => trans('product.id'),
            'image' => trans('product.image'),
            'sku' => trans('product.sku'),
            'name' => trans('product.name'),
            'price' => trans('product.price'),
            'stock' => trans('product.stock'),
            'sold' => trans('product.sold'),
            'view' => trans('product.view'),
            'kind' => trans('product.kind'),
            'type' => trans('product.type'),
            'status' => trans('product.status'),
        ];
        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('product.admin.sort_order.id_desc'),
            'id__asc' => trans('product.admin.sort_order.id_asc'),
            'name__desc' => trans('product.admin.sort_order.name_desc'),
            'name__asc' => trans('product.admin.sort_order.name_asc'),
            'sold__desc' => trans('product.admin.sort_order.sold_desc'),
            'sold__asc' => trans('product.admin.sort_order.sold_asc'),
            'view__desc' => trans('product.admin.sort_order.view_desc'),
            'view__asc' => trans('product.admin.sort_order.view_asc'),
        ];
        $obj = new ShopProduct;

        $obj = $obj
            ->leftJoin('shop_product_description', 'shop_product_description.product_id', 'shop_product.id')
            ->where('shop_product_description.lang', sc_get_locale());
        if ($keyword) {
            $obj = $obj->whereRaw('(shop_product_description.name like "%' . $keyword . '%"  OR sku like "%' . $keyword . '%")');
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);

        } else {
            $obj = $obj->orderBy('id', 'desc');
        }
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $kind = $this->kinds[$row['kind']] ?? $row['kind'];
            if ($row['kind'] == SC_PRODUCT_BUILD) {
                $kind = '<span class="label label-success">' . $kind . '</span>';
            } elseif ($row['kind'] == SC_PRODUCT_GROUP) {
                $kind = '<span class="label label-danger">' . $kind . '</span>';
            }
            $type = $this->types[$row['type']] ?? $row['type'];
            if ($row['type'] == SC_PRODUCT_NEW) {
                $type = '<span class="label label-success">' . $type . '</span>';
            } elseif ($row['type'] == SC_PRODUCT_HOT) {
                $type = '<span class="label label-danger">' . $type . '</span>';
            }

            $dataTr[] = [
                'id' => $row['id'],
                'image' => sc_image_render($row['image'], '50px'),
                'sku' => $row['sku'],
                'name' => $row['name'],
                'price' => $row['price'],
                'stock' => $row['stock'],
                'sold' => $row['sold'],
                'view' => $row['view'],
                'kind' => $kind,
                'type' => $type,
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('product.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
//menu_left
        $data['menu_left'] = '<div class="pull-left">

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('admin.refresh') . '</span></a> &nbsp;</div>
                    ';
//=menu_left

//menu_sort

        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['menu_sort'] = '
                       <div class="btn-group pull-left">
                        <div class="form-group">
                           <select class="form-control" id="order_sort">
                            ' . $optionSort . '
                           </select>
                         </div>
                       </div>

                       <div class="btn-group pull-left">
                           <a class="btn btn-flat btn-primary" title="Sort" id="button_sort">
                              <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs"> ' . trans('admin.sort') . '</span>
                           </a>
                       </div>';

        $data['script_sort'] = "$('#button_sort').click(function(event) {
      var url = '" . route('admin_report.product') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_report.product') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('product.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        return view('admin.screen.list')
            ->with($data);
    }

}
