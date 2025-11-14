// ignore_for_file: file_names, prefer_const_constructors, sort_child_properties_last, must_be_immutable, non_constant_identifier_names

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Bottom_bar/Bottom_bar.dart';
import 'package:storeappnew/Bottom_bar/terms_condition.dart';
import 'package:storeappnew/Controller_class/Delete_account_controller.dart';
import 'package:storeappnew/Controller_class/trems_condition_controller.dart';
import 'package:storeappnew/Dashboard_screens/Notification_screen.dart';
import 'package:storeappnew/Login_flow/login_Screen.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/api_screens/data_store.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class ProfileScreen extends StatefulWidget {
  String? title;
  ProfileScreen({this.title, super.key});

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  String? text;
  bool isLodding = false;
  PageListController pageListController = Get.put(PageListController());
  DeleteAccountController deleteAccountController =
      Get.put(DeleteAccountController());
  @override
  Widget build(BuildContext context) {
    return WillPopScope(
        onWillPop: () {
          Get.to(() => const BottoBarScreen());
          return Future.value(false);
        },
        child: Scaffold(
          backgroundColor: WhiteColor,
          // appBar: appbar(title: "Profile"),
          appBar: AppBar(
            leading: SizedBox(),
            centerTitle: true,
            elevation: 0,
            backgroundColor: transparent,
            title: Text(
              "Profile",
              style: TextStyle(
                fontFamily: FontFamily.gilroyBold,
                fontSize: 16,
                color: BlackColor,
              ),
            ),
          ),
          body: SingleChildScrollView(
            physics: BouncingScrollPhysics(),
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12),
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Stack(
                      children: [
                        SizedBox(
                          height: 130,
                          width: 130,
                          child: CircleAvatar(
                            backgroundColor: WhiteColor,
                            child: CircleAvatar(
                              radius: 60,
                              backgroundColor: WhiteColor,
                              backgroundImage: NetworkImage(
                                AppUrl.imageurl +
                                    getData.read("StoreLogin")["rimg"],
                              ),
                            ),
                          ),
                        ),
                        Positioned(
                          bottom: 10,
                          right: 0,
                          child: Container(
                              height: 45,
                              width: 45,
                              padding: const EdgeInsets.all(8),
                              decoration: BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: gradient.btnGradient),
                              child: Image.asset("assets/Vector.png",
                                  color: WhiteColor)),
                        )
                      ],
                    ),
                    SizedBox(height: Get.height * 0.02),
                    Text(getData.read("StoreLogin")["title"],
                        style: TextStyle(
                            fontFamily: FontFamily.gilroyBold,
                            color: BlackColor,
                            fontSize: 20)),
                    SizedBox(height: Get.height * 0.005),
                    Text(getData.read("StoreLogin")["slogan"],
                        style: TextStyle(
                            fontFamily: FontFamily.gilroyMedium,
                            color: greyColor,
                            fontSize: 16)),
                    SizedBox(height: Get.height * 0.005),
                    Text(getData.read("StoreLogin")["email"],
                        style: TextStyle(
                            fontFamily: FontFamily.gilroyMedium,
                            color: greyColor,
                            fontSize: 16)),
                    SizedBox(height: Get.height * 0.03),
                    setting(
                      SettingName: "Notification",
                      image: "assets/Notification.png",
                      onTap: () {
                        Get.to(() => NotificationScreen());
                      },
                    ),
                    // SizedBox(height: Get.height * 0.02),
                    GetBuilder<PageListController>(builder: (context) {
                      return pageListController.isLodding
                          ? ListView.builder(
                              itemCount: pageListController
                                  .dynamicPageData?.pagelist.length,
                              shrinkWrap: true,
                              itemExtent: 70,
                              physics: const NeverScrollableScrollPhysics(),
                              padding: EdgeInsets.zero,
                              itemBuilder: (context, index) {
                                return InkWell(
                                  child: Column(
                                    children: [
                                      setting(
                                        SettingName: pageListController
                                            .dynamicPageData
                                            ?.pagelist[index]
                                            .title,
                                        image: "assets/file.png",
                                        onTap: () {
                                          Get.to(() => Loream(
                                              title: pageListController
                                                  .dynamicPageData
                                                  ?.pagelist[index]
                                                  .title,
                                              discription: pageListController
                                                  .dynamicPageData
                                                  ?.pagelist[index]
                                                  .description));
                                        },
                                      ),
                                    ],
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

                    setting(
                      SettingName: "Delete Account",
                      image: "assets/trash.png",
                      onTap: () {
                        deleteSheet();
                      },
                    ),
                    setting(
                      SettingName: "Logout",
                      image: "assets/logout.png",
                      onTap: () {
                        logoutSheet();
                      },
                    )
                  ]),
            ),
          ),
        ));
  }

  setting({String? image, SettingName, Function()? onTap}) {
    return InkWell(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            height: 50,
            decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(12), color: bgcolor),
            padding: EdgeInsets.symmetric(horizontal: 12),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  children: [
                    Image.asset(image!, height: 25, color: greenColor),
                    SizedBox(width: Get.width * 0.03),
                    Text(
                      SettingName,
                      style: TextStyle(
                          fontSize: 16,
                          fontFamily: "Gilroy Bold",
                          color: BlackColor),
                    )
                  ],
                ),
                SizedBox(width: Get.width * 0.025),
                InkWell(
                  onTap: () {
                    // Get.to(() => const EditProfile());
                  },
                  child: Icon(Icons.keyboard_arrow_right_outlined,
                      color: BlackColor, size: 30),
                ),
              ],
            ),
          ),
          SizedBox(height: Get.height * 0.02),
        ],
      ),
    );
  }

  Future deleteSheet() {
    return Get.bottomSheet(
      Container(
        height: 220,
        width: Get.size.width,
        decoration: BoxDecoration(
          color: WhiteColor,
          borderRadius: BorderRadius.only(
            topLeft: Radius.circular(20),
            topRight: Radius.circular(20),
          ),
        ),
        child: Column(
          children: [
            SizedBox(
              height: 20,
            ),
            Text(
              "Delete Account".tr,
              style: TextStyle(
                fontSize: 20,
                fontFamily: "Gilroy Bold",
                color: greenColor,
              ),
            ),
            SizedBox(
              height: 20,
            ),
            Padding(
              padding: const EdgeInsets.symmetric(
                horizontal: 20,
              ),
              child: Divider(
                color: greycolor,
              ),
            ),
            SizedBox(
              height: 10,
            ),
            Text(
              "Are you sure you want to delete account?".tr,
              style: TextStyle(
                fontFamily: "Gilroy Medium",
                fontSize: 16,
                color: BlackColor,
              ),
            ),
            SizedBox(
              height: 10,
            ),
            Row(
              children: [
                Expanded(
                  child: InkWell(
                    onTap: () {
                      Get.back();
                    },
                    child: Container(
                      height: 60,
                      margin: EdgeInsets.all(15),
                      alignment: Alignment.center,
                      child: Text(
                        "Cancle".tr,
                        style: TextStyle(
                          color: greenColor,
                          fontFamily: "Gilroy Bold",
                          fontSize: 16,
                        ),
                      ),
                      decoration: BoxDecoration(
                        color: greenColor.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(45),
                      ),
                    ),
                  ),
                ),
                Expanded(
                  child: InkWell(
                    onTap: () {
                      deleteAccountController.deleteaccount();
                    },
                    child: Container(
                      height: 60,
                      margin: EdgeInsets.all(15),
                      alignment: Alignment.center,
                      child: Text(
                        "Yes, Remove".tr,
                        style: TextStyle(
                          color: WhiteColor,
                          fontFamily: "Gilroy Bold",
                          fontSize: 16,
                        ),
                      ),
                      decoration: BoxDecoration(
                        gradient: gradient.btnGradient,
                        borderRadius: BorderRadius.circular(45),
                      ),
                    ),
                  ),
                )
              ],
            )
          ],
        ),
      ),
    );
  }

  Future logoutSheet() {
    return Get.bottomSheet(
      Container(
        height: 220,
        width: Get.size.width,
        decoration: BoxDecoration(
          color: WhiteColor,
          borderRadius: BorderRadius.only(
            topLeft: Radius.circular(20),
            topRight: Radius.circular(20),
          ),
        ),
        child: Column(
          children: [
            SizedBox(height: 20),
            Text(
              "Logout".tr,
              style: TextStyle(
                  fontSize: 20,
                  fontFamily: FontFamily.gilroyBold,
                  color: RedColor),
            ),
            SizedBox(height: 20),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              child: Divider(color: greyColor),
            ),
            SizedBox(height: 10),
            Text(
              "Are you sure you want to log out?".tr,
              style: TextStyle(
                  fontFamily: FontFamily.gilroyMedium,
                  fontSize: 16,
                  color: BlackColor),
            ),
            SizedBox(height: 10),
            Row(
              children: [
                Expanded(
                  child: InkWell(
                    onTap: () {
                      Get.back();
                    },
                    child: Container(
                      height: 60,
                      margin: EdgeInsets.all(15),
                      alignment: Alignment.center,
                      child: Text(
                        "Cancle".tr,
                        style: TextStyle(
                            color: greenColor,
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 16),
                      ),
                      decoration: BoxDecoration(
                        color: greenColor.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(45),
                      ),
                    ),
                  ),
                ),
                Expanded(
                  child: InkWell(
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
                      height: 60,
                      margin: EdgeInsets.all(15),
                      alignment: Alignment.center,
                      child: Text(
                        "Yes, Logout".tr,
                        style: TextStyle(
                            color: WhiteColor,
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 16),
                      ),
                      decoration: BoxDecoration(
                          gradient: gradient.btnGradient,
                          borderRadius: BorderRadius.circular(45)),
                    ),
                  ),
                )
              ],
            )
          ],
        ),
      ),
    );
  }
}
