# API URL : http://localhost/test/API_NAME

# List of API
#All Request Are Post

1# http://localhost/test/user_add_location
   (for add location of an user)
   #parameters 
   1)user_id
   2)latitude
   3)longitude


 2# http://localhost/test/user_update_location
   (for edit user location)
   #parameters 
   1) id
   2)user_id
   3)latitude
   4)longitude


  3# http://localhost/test/user_delete_location
   (for delete user location this is soft delete)
   #parameters 
   1) id
   2)user_id

   4# http://localhost/test/get_user_location
   (this is get all user location)
   #parameters 
  
   1)user_id

   4# http://localhost/test/get_distance
  (this api take two locations latitude and longitude and unit and return distance in kms or miles)
   #parameters 
  
   1)user_id
   2)lat1
   3)lon1
   4)lat2
   5)lon2
   6)unit (if you want in kms then put "k" else "m")
  



  # Validations

  1) user id is must along with all api
  2) same user not insert previous latitude or longitude
  3) latitude and longitude must be valid in all case
  4) if user delete any location it not shown in view api because soft delte but we can restore
  5) user require the fill all parameters in the api