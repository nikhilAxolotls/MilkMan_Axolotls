// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, sized_box_for_whitespace, unnecessary_brace_in_string_interps, unnecessary_string_interpolations, prefer_typing_uninitialized_variables, file_names

import 'dart:io';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Dashboard_screens/Notification_screen.dart';
import 'package:storeappnew/Dashboard_screens/subscription_screen/subscription__history_screen.dart';
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/Controller_class/Deshboard_controller.dart';
import 'package:storeappnew/Dashboard_screens/Category_screen/My_category.dart';
import 'package:storeappnew/Dashboard_screens/Coupon_screen/Coupon_screen.dart';
import 'package:storeappnew/Dashboard_screens/Extra_image_screen/Extra_image_screen.dart';
import 'package:storeappnew/Dashboard_screens/Faq_screen/Faq_screen.dart';
import 'package:storeappnew/Dashboard_screens/Gallery_screen/Gallery_screen.dart';
import 'package:storeappnew/Dashboard_screens/product_screen/My_product.dart';
import 'package:storeappnew/Dashboard_screens/Normal_order_screen/Normal_order_screen.dart';
import 'package:storeappnew/Dashboard_screens/Rider_screen/Rider_screen.dart';
import 'package:storeappnew/Dashboard_screens/Timeslot_screen/Time_sloat_screen.dart';
import 'package:storeappnew/Dashboard_screens/product_attribute/attriburelist_screen.dart';
import 'package:storeappnew/Dashboard_screens/product_delivery/listofdelivery_screen.dart';
import 'package:storeappnew/Login_flow/login_Screen.dart';
import 'package:storeappnew/Dashboard_screens/Payout_screen/mypayout_screen.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Fontfamily.dart';
import 'package:storeappnew/api_screens/data_store.dart';

class Dashboard extends StatefulWidget {
  const Dashboard({super.key});

  @override
  State<Dashboard> createState() => _DashboardState();
}

class _DashboardState extends State<Dashboard> {
  CategoryController categoryController = Get.put(CategoryController());
  DashboardController dashboard = Get.put(DashboardController());

  List routesList = [
    Mymedicine(),
    MyCategory(),
    FaqScreen(),
    TimeSloatscreen(),
    Couponscreen(),
    RiderScreen(),
    ExtraImagescreen(),
    GalleryScreen(),
    NormalorderScreen(),
    PrescriptionOrder(),
    MyPayoutScreen()
  ];

  @override
  void initState() {
    super.initState();
    dashboard.deshboard();
    categoryController.categorylist();
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () {
        exit(0);
      },
      child: Scaffold(
        backgroundColor: bgcolor,
        appBar: AppBar(
          backgroundColor: WhiteColor,
          automaticallyImplyLeading: true,
          leadingWidth: 200,
          toolbarHeight: 60,
          elevation: 0,
          centerTitle: true,
          leading: Padding(
            padding: const EdgeInsets.only(left: 12, top: 5, bottom: 2),
            child:
                Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
              Text(
                "Hello, Welcome Back",
                style: TextStyle(
                  fontFamily: FontFamily.gilroyBold,
                  fontSize: 13,
                  color: greycolor,
                ),
              ),
              Text(
                getData.read("StoreLogin")["title"],
                maxLines: 1,
                style: TextStyle(
                  fontFamily: FontFamily.gilroyBold,
                  fontSize: 20,
                  color: BlackColor,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
              //
            ]),
          ),
          actions: [
            Padding(
              padding: const EdgeInsets.only(right: 12, top: 6),
              child: Row(
                children: [
                  InkWell(
                    onTap: () {
                      Get.to(() => NotificationScreen());
                    },
                    child: Container(
                      height: 50,
                      width: 50,
                      padding: EdgeInsets.all(12),
                      decoration:
                          BoxDecoration(shape: BoxShape.circle, color: bgcolor),
                      child: Image.asset("assets/Notification.png",
                          color: greenColor),
                    ),
                  ),
                  SizedBox(width: Get.width * 0.025),
                  InkWell(
                    onTap: () {
                      setState(() {
                        getData.remove('Firstuser');
                        getData.remove('Remember');
                        getData.remove("StoreLogin");
                        Navigator.pushReplacement(
                            context,
                            MaterialPageRoute(
                                builder: (context) => Loginscreen()));
                      });
                    },
                    child: Container(
                      height: 50,
                      width: 50,
                      padding: EdgeInsets.all(14),
                      decoration:
                          BoxDecoration(shape: BoxShape.circle, color: bgcolor),
                      child: Image.asset(
                        "assets/logout.png",
                        color: greenColor,
                      ),
                    ),
                  ),
                ],
              ),
            )
          ],
        ),
        body: RefreshIndicator(
          color: greenColor,
          onRefresh: () {
            return Future.delayed(
              Duration(seconds: 2),
              () {
                setState(() {
                  dashboard.deshboard();
                });
              },
            );
          },
          child: SizedBox(
            height: Get.size.height,
            width: Get.size.width,
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12),
              child: Column(
                children: [
                  SizedBox(height: Get.height * 0.02),
                  Expanded(
                    child: GetBuilder<DashboardController>(builder: (context) {
                      return dashboard.isLoading
                          ? GridView.builder(
                              itemCount: dashboard.dashboardlist.length,
                              shrinkWrap: true,
                              padding: EdgeInsets.zero,
                              gridDelegate:
                                  SliverGridDelegateWithFixedCrossAxisCount(
                                crossAxisCount: 2,
                                mainAxisSpacing: 8,
                                crossAxisSpacing: 8,
                                mainAxisExtent: 130,
                              ),
                              itemBuilder: (context, index) {
                                return InkWell(
                                  onTap: () {
                                    switch (index) {
                                      case 0:
                                        setState(() {});
                                        Get.to(() => Mymedicine());
                                        break;
                                      case 1:
                                        setState(() {});
                                        Get.to(() => MyCategory());
                                        break;
                                      case 2:
                                        setState(() {});
                                        Get.to(() => FaqScreen());
                                        break;
                                      case 3:
                                        setState(() {});
                                        Get.to(() => TimeSloatscreen());
                                        break;
                                      case 4:
                                        setState(() {});
                                        Get.to(() => Couponscreen());
                                        break;
                                      case 5:
                                        setState(() {});
                                        Get.to(() => RiderScreen());
                                        break;
                                      case 6:
                                        setState(() {});
                                        Get.to(() => ExtraImagescreen());
                                        break;
                                      case 7:
                                        setState(() {});
                                        Get.to(() => GalleryScreen());
                                        break;
                                      case 8:
                                        setState(() {});
                                        Get.to(() => NormalorderScreen());
                                        break;
                                      case 9:
                                        setState(() {});
                                        // Get.to(() => AcademicYear());
                                        break;
                                      case 10:
                                        setState(() {});
                                        Get.to(() => MyPayoutScreen());
                                        break;
                                      case 11:
                                        setState(() {});
                                        Get.to(() => PrescriptionOrder());
                                        break;
                                      case 12:
                                        setState(() {});
                                        Get.to(() => ListOfDeliveryScreen());
                                        break;
                                      case 13:
                                        setState(() {});
                                        Get.to(() => AttributeListScreen());
                                        break;
                                      default:
                                    }
                                    // Get.to((routesList[index]));
                                  },
                                  child: Container(
                                    child: Row(
                                      children: [
                                        SizedBox(width: 15),
                                        SizedBox(
                                          width: Get.width * 0.36,
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              SizedBox(
                                                height: 15,
                                              ),
                                              // index / 9 == 1
                                              //     ? Text(
                                              //         "${getData.read("currency")}${dashboard.dashboardlist[index]["report_data"].toString()}",
                                              //         maxLines: 1,
                                              //         style: TextStyle(
                                              //           color: WhiteColor,
                                              //           fontFamily: FontFamily
                                              //               .gilroyBold,
                                              //           fontSize: 20,
                                              //           overflow: TextOverflow
                                              //               .ellipsis,
                                              //         ),
                                              //       )
                                              //     :
                                              index / 9 == 1 ||
                                                      index / 10 == 1 ||
                                                      index / 14 == 1
                                                  ? Text(
                                                      "${getData.read("currency")}${dashboard.dashboardlist[index]["report_data"].toString()}",
                                                      maxLines: 1,
                                                      style: TextStyle(
                                                        color: WhiteColor,
                                                        fontFamily: FontFamily
                                                            .gilroyBold,
                                                        fontSize: 20,
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                      ),
                                                    )
                                                  : Text(
                                                      "${dashboard.dashboardlist[index]["report_data"].toString()}",
                                                      maxLines: 1,
                                                      style: TextStyle(
                                                        color: WhiteColor,
                                                        fontFamily: FontFamily
                                                            .gilroyBold,
                                                        fontSize: 20,
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                      ),
                                                    ),
                                              Text(
                                                "${dashboard.dashboardlist[index]["title"]}",
                                                overflow: TextOverflow.ellipsis,
                                                maxLines: 2,
                                                style: TextStyle(
                                                  fontSize: 20,
                                                  color: WhiteColor,
                                                  fontFamily: FontFamily
                                                      .gilroyExtraBold,
                                                ),
                                              ),
                                            ],
                                          ),
                                        ),
                                      ],
                                    ),
                                    decoration: BoxDecoration(
                                      color: WhiteColor,
                                      borderRadius: BorderRadius.circular(15),
                                      image: DecorationImage(
                                        image: AssetImage("assets/dImage.png"),
                                        fit: BoxFit.cover,
                                      ),
                                    ),
                                  ),
                                );
                              },
                            )
                          : Center(
                              child: CircularProgressIndicator(
                                color: greenColor,
                              ),
                            );
                    }),
                  ),
                  // SizedBox(height: Get.height * 0.03)
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  appBar() {
    return AppBar(
      backgroundColor: WhiteColor,
      automaticallyImplyLeading: true,
      leadingWidth: 200,
      elevation: 0,
      centerTitle: true,
      leading: Padding(
        padding: const EdgeInsets.only(left: 12, top: 8),
        child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
          Text(
            "Hello, Welcome Back",
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              fontSize: 13,
              color: greycolor,
            ),
          ),
          Text(
            getData.read("StoreLogin")["title"],
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              fontSize: 20,
              color: BlackColor,
            ),
          ),
          //
        ]),
      ),
      actions: [
        Padding(
          padding: const EdgeInsets.only(right: 12, top: 6),
          child: Row(
            children: [
              InkWell(
                onTap: () {
                  Get.to(() => NotificationScreen());
                },
                child: Container(
                  height: 50,
                  width: 50,
                  padding: EdgeInsets.all(12),
                  decoration:
                      BoxDecoration(shape: BoxShape.circle, color: bgcolor),
                  child:
                      Image.asset("assets/Notification.png", color: greenColor),
                ),
              ),
              SizedBox(width: Get.width * 0.025),
              InkWell(
                onTap: () {
                  setState(() {
                    getData.remove('Firstuser');
                    getData.remove('Remember');
                    getData.remove("StoreLogin");
                    Navigator.pushReplacement(context,
                        MaterialPageRoute(builder: (context) => Loginscreen()));
                  });
                },
                child: Container(
                  height: 50,
                  width: 50,
                  padding: EdgeInsets.all(14),
                  decoration:
                      BoxDecoration(shape: BoxShape.circle, color: bgcolor),
                  child: Image.asset("assets/logout.png"),
                ),
              ),
            ],
          ),
        )
      ],
    );
  }

  category({String? title, subtitle}) {
    return Container(
      height: Get.height * 0.12,
      width: Get.width * 0.45,
      padding: EdgeInsets.symmetric(horizontal: 6),
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(15),
          border: Border.all(color: Colors.grey.shade200),
          color: WhiteColor),
      child: Row(
        children: [
          Container(
            height: 60,
            width: 60,
            decoration: BoxDecoration(
                shape: BoxShape.circle, color: greyColor.withOpacity(0.08)),
          ),
          SizedBox(width: Get.width * 0.02),
          Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(title!,
                  style: TextStyle(
                    fontSize: 23,
                    color: greenColor,
                    fontFamily: FontFamily.gilroyExtraBold,
                  )),
              Text(
                subtitle,
                style: TextStyle(
                  fontSize: 17,
                  color: greenColor,
                  fontFamily: FontFamily.gilroyExtraBold,
                ),
              )
            ],
          )
        ],
      ),
    );
  }
}
