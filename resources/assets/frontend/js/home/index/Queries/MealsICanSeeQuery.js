const MealsICanSeeQuery = sourceProductsId => (
  `{
      mealsICanSee(restaurant: ${sourceProductsId}) {
        id name image_path description
      }
    }`
);

export default MealsICanSeeQuery;
