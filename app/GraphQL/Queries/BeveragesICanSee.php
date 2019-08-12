<?php

namespace App\GraphQL\Queries;

use App\Model\Product\Beverage;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class BeveragesICanSee
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param GraphQLContext $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): Collection
    {
        return Beverage::where('restaurant_id', $args['restaurant'])->get();
    }
}
