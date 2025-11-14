import 'package:get/get.dart';
import 'package:milkmennew/controller/addlocation_controller.dart';
import 'package:milkmennew/controller/cart_controller.dart';
import 'package:milkmennew/controller/catdetails_controller.dart';
import 'package:milkmennew/controller/fav_controller.dart';
import 'package:milkmennew/controller/home_controller.dart';
import 'package:milkmennew/controller/login_controller.dart';
import 'package:milkmennew/controller/myorder_controller.dart';
import 'package:milkmennew/controller/notification_controller.dart';
import 'package:milkmennew/controller/productdetails_controller.dart';
import 'package:milkmennew/controller/search_controller.dart';
import 'package:milkmennew/controller/signup_controller.dart';
import 'package:milkmennew/controller/stordata_controller.dart';
import 'package:milkmennew/controller/subscribe_controller.dart';
import 'package:milkmennew/controller/subscription_controller.dart';
import 'package:milkmennew/controller/wallet_controller.dart';
import 'package:shared_preferences/shared_preferences.dart';

init() async {
  final sharedPreferences = await SharedPreferences.getInstance();
  Get.lazyPut(() => sharedPreferences);
  Get.lazyPut(() => CatDetailsController());
  Get.lazyPut(() => AddLocationController());
  Get.lazyPut(() => PreScriptionControllre());
  Get.lazyPut(() => LoginController());
  Get.lazyPut(() => SignUpController());
  Get.lazyPut(() => HomePageController());
  Get.lazyPut(() => StoreDataContoller());
  Get.lazyPut(() => CartController());
  Get.lazyPut(() => ProductDetailsController());
  Get.lazyPut(() => FavController());
  Get.lazyPut(() => MyOrderController());
  Get.lazyPut(() => WalletController());
  Get.lazyPut(() => SearchController1());
  Get.lazyPut(() => NotificationController());
  Get.lazyPut(() => SubScibeController());
}
