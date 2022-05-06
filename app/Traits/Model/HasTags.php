<?php

namespace App\Traits\Model;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    /**
     * Get all the tags for the model.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Syncing Tags Associations
     *
     * @param array $tags
     * @return $this
     */
    public function syncTags(array $tags): static
    {
        $array = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $array[] = $tag->id;
        }


        $this->tags()->sync($array);

        return $this;
    }
}
