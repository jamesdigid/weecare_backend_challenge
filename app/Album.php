<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;
use App\AlbumImages;

class Album extends Model
{
    private $curlResponse;
    protected $table = "album";
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'itunes_id', 
        'name', 
        'title', 
        'artist_label', 
        'artist_href', 
        'item_count',
        'price',
        'rights',
        'link',
        'category_id',
        'content_type_id',
        'release_date'
    ];


    public function getAlbumFromItunesJson() {
        $this->curlResponse = Curl::to("https://itunes.apple.com/us/rss/topalbums/limit=100/json")
        ->returnResponseObject()
        ->get();
    }

    public function importAlbumsToDatabase() {

        if(is_object($this->curlResponse)) {
            $albums = json_decode($this->curlResponse->content)->feed->entry;
            if(!\App\ContentType::find(1)) {
                    
                $contentTypeArray = [
                    'content_type_attribute' => "Album",
                    'content_type' => "Music",
                ];

                $contentType = new \App\ContentType($contentTypeArray);
                $contentType->save();
            } 

            $contentTypeID = (isset($contentType->id)) ? $contentType->id : 1;

            foreach($albums as $index => $album) {
                $newAlbum = new Album;

                // If no album exist with that itunes id create one
                if($newAlbum->where("itunes_id", $album->{"id"}->{"attributes"}->{"im:id"})->count() == 0) {
                   
                    // Save Album //
                    $newAlbum->itunes_id = $album->{"id"}->{"attributes"}->{"im:id"};
                    $newAlbum->name = $album->{"im:name"}->{"label"};
                    $newAlbum->title = $album->{"title"}->{"label"};
                    
                    $newAlbum->artist_label = $album->{"im:artist"}->{"label"};


                    if(isset($album->{"im:artist"}->{"attributes"})) {
                        $newAlbum->artist_href = $album->{"im:artist"}->{"attributes"}->{"href"};
                    }
                    
                    
                    $newAlbum->item_count = $album->{"im:itemCount"}->{"label"};
                    $newAlbum->price = $album->{"im:price"}->{"label"};
                    $newAlbum->rights = $album->{"rights"}->{"label"};
                    $newAlbum->link = $album->{"link"}->{"attributes"}->{"href"};

                    $newAlbum->content_type_id = $contentTypeID;

                    $newAlbum->release_date = $album->{"im:releaseDate"}->{"label"};

    
                    // Save Category //
                    $itunesID = $album->{"category"}->{"attributes"}->{"im:id"};

                    if(!$categoryID = \App\Category::where('itunes_id', $itunesID)->first()) {
                    
                        $categoryArray = [
                            'itunes_id' => $itunesID,
                            'term' => $album->{"category"}->{"attributes"}->{"term"},
                            'scheme' => $album->{"category"}->{"attributes"}->{"scheme"}
                        ];

                
                        $createCategory = $newAlbum->category()->create($categoryArray);
                        $newAlbum->category()->associate($createCategory);


                    } else {
                        $newAlbum->category_id = $categoryID->id;
                    }

                    $newAlbum->save();

                    foreach($album->{"im:image"} as $index => $image) {
                        $albumImagesObjectArray[$index] = new AlbumImages([
                            'label' => $image->{"label"},
                            'height'=> $image->{"attributes"}->{"height"}
                        ]);


                    }
                    
                    $newAlbum->albumImages()->saveMany($albumImagesObjectArray);
                }
            }

        }

    }
    
    /**
     * Relationships
     */

    public function contentType() {
        return $this->belongsTo("App\ContentType");
    }

    public function category() {
        return $this->belongsTo("App\Category");
    }

    public function albumImages() {
        return $this->hasMany("App\AlbumImages");
    }

}
