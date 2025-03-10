<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use \App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image');
            if(!is_null($id)){ // null判定
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId;
                if($imageId !== Auth::id()){ // 同じでなかったら
                    abort(404); // 404画面表示
                }
            }

            return $next($request);
        });

    }
    public function index()
    {
        //
        $images = Image::where('owner_id', Auth::id())
            ->orderBy('updated_at','desc')
            ->paginate(20);
        return view('owner.images.index',
            compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //
//        dd($request);

        $imageFiles = $request->file('files');
        if(!is_null($imageFiles)){
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile,'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore,
                ]);
            }
        }
        return redirect()
            ->route('owner.images.index')
            ->with(['message' => '画像登録を実施しました。',
                'status' => 'info' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('owner.images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50'
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->name;

        $image->save();

        return redirect()
            ->route('owner.images.index')
            ->with(['message' => '画僧情報を更新しました。',
                'status' => 'info' ]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $filePath = 'public/products' . $image->filename;

        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()
            ->route('admin.images.index')
            ->with(['message' => '画像を削除しました。',
                'status' => 'alert']);
    }
}
