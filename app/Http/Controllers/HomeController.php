<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\BasicSetting;
use App\Category;
use App\Channel;
use App\ChildCategory;
use App\Comment;
use App\Menu;
use App\Order;
use App\OrderItem;
use App\Product;
use App\ProductImage;
use App\ProductSpecification;
use App\Review;
use App\Slider;
use App\Speciality;
use App\Subcategory;
use App\Subscribe;
use App\Testimonial;
use App\TraitsFolder\CommonTrait;
use App\User;
use App\UserDetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactMail;

class HomeController extends Controller
{
    use CommonTrait;
    /**
     * Créez une nouvelle instance de contrôleur.
     *
     * @return void
     */

    /**
     * Affichez le tableau de bord de l'application.
     *
     * @return \Illuminate\Http\Response
     */

     /**
      * cette fonction affiche tous les éléments de la page d'accueil
      */
    public function getIndex()
    {
        $data['page_title'] = "Page d'acceuil";
        $data['slider'] = Slider::all();
        $data['speciality'] = Speciality::all();
        $data['category'] = Category::all();
        $data['testimonial'] = Testimonial::all();
        // c'est ici que je gère la pagination,dans ce cas c'est 6 mais peut changer
        $data['latestProduct'] = Product::orderBy('id','desc')->paginate(6);
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(6)
            ->paginate(6);
        return view('home.home',$data);
    }

    public function getAbout()
    {
        $data['page_title'] = "About Page";
        $data['testimonial'] = Testimonial::all();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['testimonial_hide'] = 0;
        return view('home.about',$data);
    }

    public function getTermsCondition()
    {
        $data['page_title'] = "Conditions";
        $data['testimonial'] = Testimonial::all();
        $data['testimonial_hide'] = 1;
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        return view('home.about',$data);
    }
    public function getPrivacyPolicy()
    {
        $data['page_title'] = "Privacy Policy Page";
        $data['testimonial'] = Testimonial::all();
        $data['testimonial_hide'] = 1;
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        return view('home.about',$data);
    }

    public function getContact()
    {
        $data['page_title'] = "Contact";
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        return view('home.contact');
   
    }
    public function submitContact(Request $request)
    {     
        $data = request()->validate([

           'name' => 'required',
           'email' => 'required|email',
           'subject' => 'required',
           'phone' => 'required',
           'message' => 'required'
         

   ]);
   //dd($data);
        //Mail::to('test@test.com')->send(contactMail());
        //$this->sendContact($request->email,$request->name,$request->subject,$request->message,$request->phone);
        //session()->flash('message','Message envoyé avec succès.');
        //return view('emails.contactMail');
    }

    public function submitSubscribe(Request $request)
    {
        $request->validate([
           'email' => 'required|email|unique:subscribes,email'
        ]);
        $in = Input::except('_method','_token');
        Subscribe::create($in);
        session()->flash('message','Inscription terminée.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function getCategoryProduct($id, $slug)
    {
        $category = Category::findOrFail($id);
        $data['page_title'] = $category->name." - Produits";
        $data['product'] = Product::whereCategory_id($id)->whereStatus(1)->orderBy('id','desc')->paginate(66);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        $data['start_price'] = 0; 
        $data['end_price'] = 1000;
        
        return view('home.category',$data);
    }
    public function getSubCategoryProduct($id, $slug)
    {
        $category = Subcategory::findOrFail($id);
        $data['page_title'] = $category->name." - Produits";
        $data['product'] = Product::whereSubcategory_id($id)->orderBy('id','desc')->paginate(6);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        $data['start_price'] = 0; 
        $data['end_price'] = 1000;

        return view('home.category',$data);
    }
    public function getChildCategoryProduct($id, $slug)
    {
        $category = ChildCategory::findOrFail($id);
        $data['page_title'] = $category->name." - Produits";
        $data['product'] = Product::whereChildcategory_id($id)->orderBy('id','desc')->paginate(6);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(5)
            ->get();
        $data['start_price'] = 0; 
        $data['end_price'] = 1000;

        return view('home.category',$data);
    }

    public function rangePrice(Request $request)
    {
        
        // print_r($request->range_price);
        $basic = BasicSetting::first();
        $rr = explode('-',$request->range_price);
        //var_dump($rr);
        $start = (float)str_replace($basic->symbol, "", trim($rr[0]));
        //$end = str_replace($basic->symbol, "", trim($rr[1]));
        if (!isset($rr[1])) {
            $end = '50000';
          
        } else {
              
            $end = (float)str_replace($basic->symbol, "", trim($rr[1]));
        
        }
        // print_r($start . ' - ' . $end);
        $data['page_title'] = ""; 
        $data['product'] = Product::whereBetween('current_price', [$start, $end])->orderBy('id','desc')->paginate(1000);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
       
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(6)
            ->paginate(1000);

        $data['start_price'] = $start; 
        $data['end_price'] = $end;

        return view('home.category',$data);

    }
    public function getSearchProduct(Request $request)
    {
        $data['page_title'] = $request->name." - Produits";
        $data['product'] = Product::where('name','like','%' . Input::get('name') . '%')->orderBy('id','desc')->paginate(66);
        $data['category'] = Category::all();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['bestSell'] = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderBy('total_qty','desc')
            ->take(6)
            ->get();
        $data['start_price'] = 0; 
        $data['end_price'] = 1000;
        return view('home.category',$data);
    }

    /**
     * Supprimez la ressource spécifiée du stockage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(Product::destroy($id)){
            foreach (Language::all() as $key => $language) {
                $data = openJSONFile($language->code);
                unset($data[$product->name]);
                saveJSONFile($language->code, $data);
            }
            if($product->thumbnail_img != null){
                //unlink($product->thumbnail_img);
            }
            if($product->featured_img != null){
                //unlink($product->featured_img);
            }
            if($product->flash_deal_img != null){
                //unlink($product->flash_deal_img);
            }
            foreach (json_decode($product->photos) as $key => $photo) {
                //unlink($photo);
            }
            flash(__('Le produit a été supprimé avec succès'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('products.admin');
            }
            else{
                return redirect()->route('seller.products');
            }
        }
        else{
            flash(__('Quelque chose a mal tourné'))->error();
            return back();
        }
    }
    
    public function getProductDetails($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $product->view = $product->view + 1;
        $data['page_title'] = $product->name;
        $data['category'] = Category::all();
        $data['product'] = $product;
        $data['productImage'] = ProductImage::whereProduct_id($product->id)->get();
        $data['productSpecification'] = ProductSpecification::whereProduct_id($product->id)->get();
        $data['productTag'] = explode(',',$product->tags);
        $data['relatedProduct'] = Product::whereCategory_id($product->category_id)->take(10)->get();
        $product->save();
        $data['productReviews'] = Review::whereProduct_id($product->id)->get();
        $data['productComment'] = Comment::whereProduct_id($product->id)->get();
        $data['ad1'] = Advertisement::whereAdvert_size(1)->inRandomOrder()->first();
        $data['ad2'] = Advertisement::whereAdvert_size(2)->inRandomOrder()->first();
        $data['ad3'] = Advertisement::whereAdvert_size(3)->inRandomOrder()->first();
        $data['ad4'] = Advertisement::whereAdvert_size(4)->inRandomOrder()->first();
        $data['meta_status'] = 2;
        return view('home.product-details',$data);
    }

    public function submitFriendEmail(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'ownEmail' => 'email|required',
            'friendEmail' => 'email|required',
            'url' => 'required|url',
        ]);
        $this->friendEmail($request->name,$request->ownEmail,$request->friendEmail,$request->url,$request->message);
        session()->flash('message','Email envoyé avec succès.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function getCart()
    {
        $data['page_title'] = 'Panier';
//        Cart::destroy();
        return view('home.cart',$data);
    }

    public function orderCompleted($oderNumber)
    {
        $data['page_title'] = 'Commande confirmée';
        $data['order'] = Order::whereOrder_number($oderNumber)->first();
        if ($data['order'] == null){
            session()->flash('message','N° Commande invalide.');
            session()->flash('type','warning');
            return redirect()->route('home');
        }else{
            $data['orderItem'] = OrderItem::whereOrder_id($data['order']->id)->get();
            $data['userDetails'] = UserDetails::whereUser_id($data['order']->user_id)->first();
        }
        return view('home.order-confirm',$data);
    }

    public function submitCronJob()
    {
        $order = Order::whereStatus(0)->get();
        foreach ($order as $c){
            $now = Carbon::now();
            if ($c->expire_time < $now){
                $c->status = 2;
                $items = OrderItem::whereOrder_id($c->id)->get();
                foreach ($items as $t){
                    $product = Product::findOrFail($t->product_id);
                    $product->stock = $product->stock + $t->qty;
                    $product->save();
                }
                $c->save();
            }
        }
        
        session()->flash('message','Cammandes expirées supprimées.');
        session()->flash('type','success');
        return redirect()->back();
    }
}
