// ignore_for_file: sort_child_properties_last, prefer_const_constructors, prefer_const_literals_to_create_immutables, unnecessary_brace_in_string_interps, file_names, avoid_print

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_coupon_controller.dart';
import 'package:storeappnew/Controller_class/Coupon_controller.dart';
import 'package:storeappnew/Dashboard_screens/Coupon_screen/Add_coupon_screen.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class Couponscreen extends StatefulWidget {
  const Couponscreen({super.key});

  @override
  State<Couponscreen> createState() => _CouponscreenState();
}

class _CouponscreenState extends State<Couponscreen> {
  @override
  void initState() {
    super.initState();
    couponlistController.couponlist();
  }

  CouponlistController couponlistController = Get.put(CouponlistController());
  AddCouponlistController addCouponlistController =
      Get.put(AddCouponlistController());
  String expiredate = "";
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      appBar: CustomAppbar(
          onTap: () {
            Get.to((() => AddCouponscreen(
                  add: "Add",
                )));
          },
          title: "My Coupon"),
      body: SafeArea(
        child: Column(
          children: [
            SizedBox(
              height: 20,
            ),
            Expanded(
              child: Container(
                padding: EdgeInsets.symmetric(horizontal: 10),
                child: GetBuilder<CouponlistController>(builder: (context) {
                  return couponlistController.isLoading
                      ? ListView.builder(
                          itemCount: couponlistController
                              .coupondatainfo?.coupondata.length,
                          physics: BouncingScrollPhysics(),
                          itemBuilder: (context, index) {
                            return InkWell(
                              onTap: () {
                                print(
                                    "!!!!!!!!!!!!!!recordid!!!!!!!!!!!!!!!!!${couponlistController.coupondatainfo?.coupondata[index].id ?? ""}");
                                Get.to(() => AddCouponscreen(
                                      recordid: couponlistController
                                              .coupondatainfo
                                              ?.coupondata[index]
                                              .id ??
                                          "",
                                      add: "Add",
                                    ));
                              },
                              child: Stack(
                                children: [
                                  Container(
                                    height: 125,
                                    width: Get.size.width,
                                    margin: EdgeInsets.all(10),
                                    child: Row(
                                      children: [
                                        Stack(
                                          children: [
                                            Container(
                                              height: 125,
                                              width: 110,
                                              margin: EdgeInsets.all(10),
                                              child: ClipRRect(
                                                borderRadius:
                                                    BorderRadius.circular(15),
                                                child: Image.network(
                                                  "${AppUrl.imageurl}${couponlistController.coupondatainfo?.coupondata[index].couponImg ?? ""}",
                                                  height: 140,
                                                  fit: BoxFit.cover,
                                                ),
                                              ),
                                              decoration: BoxDecoration(
                                                borderRadius:
                                                    BorderRadius.circular(15),
                                              ),
                                            ),
                                          ],
                                        ),
                                        SizedBox(
                                          width: 4,
                                        ),
                                        Expanded(
                                          child: Column(
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Row(
                                                children: [
                                                  Expanded(
                                                    child: Padding(
                                                      padding: EdgeInsets.only(
                                                          top: 30),
                                                      child: Text(
                                                        couponlistController
                                                                .coupondatainfo
                                                                ?.coupondata[
                                                                    index]
                                                                .title ??
                                                            "",
                                                        maxLines: 2,
                                                        style: TextStyle(
                                                          fontSize: 16,
                                                          fontFamily: FontFamily
                                                              .gilroyBold,
                                                          color: BlackColor,
                                                          overflow: TextOverflow
                                                              .ellipsis,
                                                        ),
                                                      ),
                                                    ),
                                                  ),
                                                ],
                                              ),
                                              GetBuilder<CouponlistController>(
                                                  builder: (context) {
                                                expiredate =
                                                    "${couponlistController.coupondatainfo?.coupondata[index].expireDate}"
                                                        .split(" ")
                                                        .first
                                                        .toString();

                                                return Row(
                                                  children: [
                                                    Expanded(
                                                      child: Text(
                                                        "Exp: $expiredate",
                                                        maxLines: 2,
                                                        style: TextStyle(
                                                          color: greyColor,
                                                          fontFamily: FontFamily
                                                              .gilroyMedium,
                                                          overflow: TextOverflow
                                                              .ellipsis,
                                                        ),
                                                      ),
                                                    ),
                                                    Padding(
                                                      padding: EdgeInsets.only(
                                                          top: 8),
                                                      child: Column(
                                                        children: [
                                                          Text(
                                                            "${currency}${couponlistController.coupondatainfo?.coupondata[index].couponVal ?? ""}",
                                                            style: TextStyle(
                                                              fontSize: 17,
                                                              fontFamily:
                                                                  FontFamily
                                                                      .gilroyBold,
                                                              color: blueColor,
                                                            ),
                                                          ),
                                                        ],
                                                      ),
                                                    ),
                                                    SizedBox(
                                                      width: 10,
                                                    ),
                                                  ],
                                                );
                                              }),
                                              SizedBox(
                                                height: 5,
                                              ),
                                            ],
                                          ),
                                        )
                                      ],
                                    ),
                                    decoration: BoxDecoration(
                                      border: Border.all(
                                          color: Colors.grey.shade200),
                                      color: WhiteColor,
                                      borderRadius: BorderRadius.circular(15),
                                    ),
                                  ),
                                  Positioned(
                                    top: 0,
                                    right: 0,
                                    child: InkWell(
                                        onTap: () {
                                          print(
                                              "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!${couponlistController.coupondatainfo?.coupondata[index].id ?? ""}");
                                          Get.to(() => AddCouponscreen(
                                                add: "edit",
                                                recordid: couponlistController
                                                        .coupondatainfo
                                                        ?.coupondata[index]
                                                        .id ??
                                                    "",
                                              ));
                                          addCouponlistController.getEditDetails(
                                              Editcouponimage: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .couponImg,
                                              Editcoupontitle: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .title,
                                              Editcouponcode: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .couponCode,
                                              Editcouponsubtitle: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .subtitle,
                                              Editexpiredate1: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .expireDate
                                                  .toString(),
                                              Editcouponminorder:
                                                  couponlistController
                                                      .coupondatainfo
                                                      ?.coupondata[index]
                                                      .minAmt,
                                              editcouponvalue: couponlistController
                                                  .coupondatainfo
                                                  ?.coupondata[index]
                                                  .couponVal,
                                              EditCoupondiscription:
                                                  couponlistController
                                                      .coupondatainfo
                                                      ?.coupondata[index]
                                                      .description,
                                              estatus: couponlistController.coupondatainfo?.coupondata[index].status);
                                        },
                                        child: Container(
                                          height: 35,
                                          width: 35,
                                          padding: EdgeInsets.all(9),
                                          alignment: Alignment.center,
                                          child: Image.asset("assets/Edit.png"),
                                          decoration: BoxDecoration(
                                            shape: BoxShape.circle,
                                            color: greenColor,
                                          ),
                                        )),
                                  )
                                  // : SizedBox(),
                                ],
                              ),
                            );
                          },
                        )
                      : Center(child: CircularProgressIndicator());
                }),
                decoration: BoxDecoration(
                  color: WhiteColor,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
