<?php
#app/Http/Controller/ContentFront.php
namespace App\Http\Controllers;

use App\Models\ShopEmailTemplate;
use App\Models\ShopNews;
use App\Models\ShopPage;
use App\Models\ShopSubscribe;
use Illuminate\Http\Request;

class ContentFront extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getContact description]
     * @return [type] [description]
     */
    public function getContact()
    {
        $page = $this->getPage('contact');
        return view(
            $this->templatePath . '.shop_contact',
            array(
                'title' => trans('front.contact'),
                'description' => '',
                'page' => $page,
                'keyword' => '',
                'og_image' => '',
            )
        );
    }

    /**
     * [postContact description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postContact(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[^0][0-9\-]{7,13}$/',
        ], [
            'name.required' => trans('validation.required'),
            'content.required' => trans('validation.required'),
            'title.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'phone.required' => trans('validation.required'),
            'phone.regex' => trans('validation.phone'),
        ]);
        //Send email
        $data = $request->all();
        $data['content'] = str_replace("\n", "<br>", $data['content']);

        if (sc_config('contact_to_admin')) {
            $checkContent = (new ShopEmailTemplate)
                ->where('group', 'contact_to_admin')
                ->where('status', 1)
                ->first();
            if ($checkContent) {
                $content = $checkContent->text;
                $dataFind = [
                    '/\{\{\$title\}\}/',
                    '/\{\{\$name\}\}/',
                    '/\{\{\$email\}\}/',
                    '/\{\{\$phone\}\}/',
                    '/\{\{\$content\}\}/',
                ];
                $dataReplace = [
                    $data['title'],
                    $data['name'],
                    $data['email'],
                    $data['phone'],
                    $data['content'],
                ];
                $content = preg_replace($dataFind, $dataReplace, $content);
                $data_email = [
                    'content' => $content,
                ];

                $config = [
                    'to' => sc_store('email'),
                    'replyTo' => $data['email'],
                    'subject' => $data['title'],
                ];
                sc_send_mail('mail.contact_to_admin', $data_email, $config, []);
            }
        }

        return redirect()
            ->route('contact')
            ->with('success', trans('front.thank_contact'));
    }

    /**
     * Render page
     * @param  [string] $alias
     */
    public function pages($alias = null)
    {
        $page = $this->getPage($alias);
        if ($page) {
            return view(
                $this->templatePath . '.shop_page',
                array(
                    'title' => $page->title,
                    'description' => '',
                    'keyword' => '',
                    'page' => $page,
                )
            );
        } else {
            return $this->pageNotFound();
        }
    }

    /**
     * Get page info
     * @param  [string] $alias [description]
     * @return [type]      [description]
     */
    public function getPage($alias = null)
    {
        return ShopPage::where('alias', $alias)
            ->where('status', 1)
            ->first();
    }

    /**
     * Render news
     * @return [type] [description]
     */
    public function news()
    {
        $news = (new ShopNews)
            ->getItemsNews($limit = sc_config('product_new'), $opt = 'paginate');
        return view(
            $this->templatePath . '.shop_news',
            array(
                'title' => trans('front.blog'),
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'news' => $news,
            )
        );
    }

    /**
     * News detail
     *
     * @param   [string]  $alias 
     * @param   [type]  $id
     *
     * @return  view
     */
    public function newsDetail($alias)
    {
        $news_currently = ShopNews::where('alias', $alias)->first();
        if ($news_currently) {
            $title = ($news_currently) ? $news_currently->title : trans('front.not_found');
            return view(
                $this->templatePath . '.shop_news_detail',
                array(
                    'title' => $title,
                    'news_currently' => $news_currently,
                    'description' => sc_store('description'),
                    'keyword' => sc_store('keyword'),
                    'blogs' => (new ShopNews)->getItemsNews($limit = 4),
                    'og_image' => $news_currently->getImage(),
                )
            );
        } else {
            return view(
                $this->templatePath . '.notfound',
                array(
                    'title' => trans('front.not_found'),
                    'description' => '',
                    'keyword' => sc_store('keyword'),
                    'msg' => trans('front.item_not_found'),
                )
            );
        }
    }

    /**
     * email subscribe
     * @param  Request $request
     * @return json
     */
    public function emailSubscribe(Request $request)
    {
        $validator = $request->validate([
            'subscribe_email' => 'required|email',
            ], [
            'email.required' => trans('validation.required'),
            'email.email'    => trans('validation.email'),
        ]);
        $data       = $request->all();
        $checkEmail = ShopSubscribe::where('email', $data['subscribe_email'])
            ->first();
        if (!$checkEmail) {
            ShopSubscribe::insert(['email' => $data['subscribe_email']]);
        }
        return redirect()->back()
            ->with(['success' => trans('subscribe.subscribe_success')]);
    }
}
