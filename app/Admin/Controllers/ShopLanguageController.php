<?php
#app/Http/Admin/Controllers/ShopLanguageController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopLanguage;
use Illuminate\Http\Request;
use Validator;

class ShopLanguageController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('language.admin.list'),
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
            'id' => trans('language.id'),
            'name' => trans('language.name'),
            'code' => trans('language.code'),
            'icon' => trans('language.icon'),
            'sort' => trans('language.sort'),
            'status' => trans('language.status'),
            'action' => trans('language.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('language.admin.sort_order.id_desc'),
            'id__asc' => trans('language.admin.sort_order.id_asc'),
            'name__desc' => trans('language.admin.sort_order.name_desc'),
            'name__asc' => trans('language.admin.sort_order.name_asc'),
        ];
        $obj = new ShopLanguage;
        if ($keyword) {
            $obj = $obj->whereRaw('(code = "' . $keyword . '" OR name like "%' . $keyword . '%" )');
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
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'code' => $row['code'],
                'icon' => sc_image_render($row['icon'], '30px', '30px'),
                'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('admin_language.edit', ['id' => $row['id']]) . '"><span title="' . trans('language.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span ' . (in_array($row['id'], SC_GUARD_LANGUAGE) ? "style='display:none'" : "") . ' onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('language.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('language.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('language.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_language.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('language.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

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
      var url = '" . route('admin_language.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_language.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('language.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_language.delete');

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new
 * @return [type] [description]
 */
    public function create()
    {
        $data = [
            'title' => trans('language.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('language.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'language' => [],
            'url_action' => route('admin_language.create'),
        ];
        return view('admin.screen.language')
            ->with($data);
    }

/**
 * Post create
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'icon' => 'required',
            'sort' => 'numeric|min:0',
            'name' => 'required|string|max:100',
            'code' => 'required|unique:shop_language,code',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'icon' => $data['icon'],
            'name' => $data['name'],
            'code' => $data['code'],
            'status' => empty($data['status']) ? 0 : 1,
            'sort' => (int) $data['sort'],
        ];
        ShopLanguage::create($dataInsert);

        return redirect()->route('admin_language.index')->with('success', trans('language.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $language = ShopLanguage::find($id);
        if ($language === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('language.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'language' => $language,
            'url_action' => route('admin_language.edit', ['id' => $language['id']]),
        ];
        return view('admin.screen.language')
            ->with($data);
    }

/**
 * update
 */
    public function postEdit($id)
    {
        $language = ShopLanguage::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'icon' => 'required',
            'name' => 'required',
            'sort' => 'numeric|min:0',
            'code' => 'required|unique:shop_language,code,' . $language->id . ',id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'icon' => $data['icon'],
            'name' => $data['name'],
            'code' => $data['code'],
            'sort' => $data['sort'],
        ];
        //Check status before change
        $check = ShopLanguage::where('status', 1)->where('code', '<>', $data['code'])->count();
        if ($check) {
            $dataUpdate['status'] = empty($data['status']) ? 0 : 1;
        } else {
            $dataUpdate['status'] = 1;
        }
        //End check status
        $obj = ShopLanguage::find($id);
        $obj->update($dataUpdate);

//
        return redirect()->route('admin_language.index')->with('success', trans('language.admin.edit_success'));

    }

/*
Delete list item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            $arrID = array_diff($arrID, SC_GUARD_LANGUAGE);
            ShopLanguage::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
