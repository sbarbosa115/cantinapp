const MealsICanSeeQuery = sourceProductsId => (
  `{
      mealsICanSee(restaurant: ${sourceProductsId}) {
        id name image_path
      }
    }`
);

export default MealsICanSeeQuery;
