// ignore_for_file: prefer_const_constructors, non_constant_identifier_names, sort_child_properties_last, avoid_print, must_be_immutable, file_names, unrelated_type_equality_checks, unnecessary_brace_in_string_interps

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Bottom_bar/Bottom_bar.dart';
import 'package:storeappnew/Controller_class/Addrider_controller.dart';
import 'package:storeappnew/Controller_class/Assign_rider_controller.dart';
import 'package:storeappnew/Controller_class/Order_details_controller.dart';
import 'package:storeappnew/Controller_class/Rider_controller.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class OrderdetailsScreen extends StatefulWidget {
  String? ordertype;
  String? oid;
  String? bottombar;
  OrderdetailsScreen({this.ordertype, this.oid, this.bottombar, super.key});

  @override
  State<OrderdetailsScreen> createState() => _OrderdetailsScreenState();
}

class _OrderdetailsScreenState extends State<OrderdetailsScreen> {
  RiderlistController riderlistController = Get.put(RiderlistController());
  OrderdetailController orderdetailController =
      Get.put(OrderdetailController());
  AddRiderController addRiderController = Get.put(AddRiderController());
  AssignriderController assignriderController =
      Get.put(AssignriderController());

  bool usercontect = false;
  bool usercontect1 = false;
  String? slectStatus;
  @override
  void initState() {
    super.initState();
    print("################################${widget.oid}");
    orderdetailController.orderdetailslist(oid: widget.oid);
    riderlistController.riderlist();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bgcolor,
      bottomNavigationBar:
          GetBuilder<OrderdetailController>(builder: (context) {
        return orderdetailController.orderdetailsinfo?.orderdata.flowId != "7"
            ? orderdetailController.orderdetailsinfo?.orderdata.orderType ==
                    "Self Pickup"
                ? orderdetailController
                                .orderdetailsinfo?.orderdata.orderStatus !=
                            "Completed" &&
                        orderdetailController
                                .orderdetailsinfo?.orderdata.orderStatus !=
                            "Cancelled"
                    ? Container(
                        color: WhiteColor,
                        height: Get.height * 0.09,
                        child: Padding(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Row(
                                    children: [
                                      Text(
                                          "$currency${orderdetailController.orderdetailsinfo?.orderdata.orderTotal ?? ""}",
                                          style: TextStyle(
                                              fontFamily: FontFamily.gilroyBold,
                                              color: BlackColor,
                                              fontSize: 18)),
                                      SizedBox(width: Get.width * 0.02),
                                      Image.asset("assets/downarrow.png",
                                          height: 14, width: 14)
                                    ],
                                  ),
                                  SizedBox(height: Get.height * 0.005),
                                  Text("Total Peyment ",
                                      style: TextStyle(
                                          fontFamily: FontFamily.gilroyMedium,
                                          color: greyColor,
                                          fontSize: 16)),
                                ],
                              ),
                              InkWell(
                                child: orderdetailController.orderdetailsinfo
                                            ?.orderdata.flowId ==
                                        "1"
                                    ? InkWell(
                                        onTap: () {
                                          orderdetailController
                                              .orderdetailslist(
                                                  oid: widget.oid);
                                          assignriderController
                                              .ordercompletedlist(
                                            oid: widget.oid,
                                          );
                                          Dialogbox();
                                        },
                                        child: Container(
                                            height: 50,
                                            width: Get.width * 0.45,
                                            alignment: Alignment.center,
                                            decoration: BoxDecoration(
                                                borderRadius:
                                                    BorderRadius.circular(12),
                                                gradient: gradient.btnGradient),
                                            child: Text("Completed",
                                                style: TextStyle(
                                                    fontFamily:
                                                        FontFamily.gilroyBold,
                                                    color: WhiteColor,
                                                    fontSize: 16))),
                                      )
                                    : GetBuilder<OrderdetailController>(
                                        builder: (context) {
                                        return InkWell(
                                          onTap: () {
                                            setState(() {
                                              assignriderController
                                                  .mackdisitionlist(
                                                      oid: widget.oid);
                                            });
                                          },
                                          child: Container(
                                              height: 50,
                                              width: Get.width * 0.45,
                                              alignment: Alignment.center,
                                              decoration: BoxDecoration(
                                                  borderRadius:
                                                      BorderRadius.circular(12),
                                                  gradient:
                                                      gradient.btnGradient),
                                              child: Text("Accept",
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: WhiteColor,
                                                      fontSize: 16))),
                                        );
                                      }),
                              )
                            ],
                          ),
                        ),
                      )
                    : SizedBox()
                : orderdetailController
                                .orderdetailsinfo?.orderdata.orderStatus !=
                            "Completed" &&
                        orderdetailController
                                .orderdetailsinfo?.orderdata.orderStatus !=
                            "Cancelled"
                    ? orderdetailController
                                .orderdetailsinfo?.orderdata.flowId !=
                            "5"
                        ? Container(
                            color: WhiteColor,
                            height: Get.height * 0.09,
                            child: Padding(
                              padding: EdgeInsets.symmetric(
                                  horizontal: 12, vertical: 12),
                              child: Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Row(
                                        children: [
                                          Text(
                                              "$currency${orderdetailController.orderdetailsinfo?.orderdata.orderTotal ?? ""}",
                                              style: TextStyle(
                                                  fontFamily:
                                                      FontFamily.gilroyBold,
                                                  color: BlackColor,
                                                  fontSize: 18)),
                                          SizedBox(width: Get.width * 0.02),
                                          Image.asset("assets/downarrow.png",
                                              height: 14, width: 14)
                                        ],
                                      ),
                                      SizedBox(height: Get.height * 0.005),
                                      Text("Total Peyment ",
                                          style: TextStyle(
                                              fontFamily:
                                                  FontFamily.gilroyMedium,
                                              color: greyColor,
                                              fontSize: 16)),
                                    ],
                                  ),
                                  InkWell(
                                    child: orderdetailController
                                                .orderdetailsinfo
                                                ?.orderdata
                                                .flowId ==
                                            "0"
                                        ? GetBuilder<OrderdetailController>(
                                            builder: (context) {
                                            return InkWell(
                                              onTap: () {
                                                setState(() {
                                                  orderdetailController
                                                      .orderdetailslist(
                                                          oid: widget.oid);
                                                  assignriderController
                                                      .mackdisitionlist(
                                                          oid: widget.oid);
                                                });
                                              },
                                              child: Container(
                                                height: 50,
                                                width: Get.width * 0.45,
                                                alignment: Alignment.center,
                                                decoration: BoxDecoration(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                            12),
                                                    gradient:
                                                        gradient.btnGradient),
                                                child: Text(
                                                  "Accept",
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: WhiteColor,
                                                      fontSize: 16),
                                                ),
                                              ),
                                            );
                                          })
                                        : orderdetailController.orderdetailsinfo
                                                    ?.orderdata.flowId ==
                                                "1"
                                            ? InkWell(
                                                onTap: () {
                                                  orderdetailController
                                                      .orderdetailslist(
                                                          oid: widget.oid);
                                                  bottomsheet();
                                                },
                                                child: Container(
                                                    height: 50,
                                                    width: Get.width * 0.45,
                                                    alignment: Alignment.center,
                                                    decoration: BoxDecoration(
                                                        borderRadius:
                                                            BorderRadius.circular(
                                                                12),
                                                        gradient: gradient
                                                            .btnGradient),
                                                    child: Text("Assign",
                                                        style: TextStyle(
                                                            fontFamily:
                                                                FontFamily
                                                                    .gilroyBold,
                                                            color: WhiteColor,
                                                            fontSize: 16))),
                                              )
                                            : Container(
                                                height: 50,
                                                width: Get.width * 0.45,
                                                alignment: Alignment.center,
                                                decoration: BoxDecoration(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                            12),
                                                    gradient:
                                                        gradient.btnGradient),
                                                child: Text(
                                                  "Assigned",
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: WhiteColor,
                                                      fontSize: 16),
                                                ),
                                              ),
                                  )
                                ],
                              ),
                            ),
                          )
                        : orderdetailController
                                    .orderdetailsinfo?.orderdata.flowId ==
                                "5"
                            ? Container(
                                color: WhiteColor,
                                height: Get.height * 0.09,
                                child: Padding(
                                  padding: EdgeInsets.symmetric(
                                      horizontal: 12, vertical: 12),
                                  child: Row(
                                    mainAxisAlignment:
                                        MainAxisAlignment.spaceBetween,
                                    children: [
                                      Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Row(
                                            children: [
                                              Text(
                                                  "$currency${orderdetailController.orderdetailsinfo?.orderdata.orderTotal ?? ""}",
                                                  style: TextStyle(
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: BlackColor,
                                                      fontSize: 18)),
                                              SizedBox(width: Get.width * 0.02),
                                              Image.asset(
                                                  "assets/downarrow.png",
                                                  height: 14,
                                                  width: 14)
                                            ],
                                          ),
                                          SizedBox(height: Get.height * 0.005),
                                          Text("Total Peyment",
                                              style: TextStyle(
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                  color: greyColor,
                                                  fontSize: 16)),
                                        ],
                                      ),
                                      GetBuilder<OrderdetailController>(
                                          builder: (context) {
                                        return InkWell(
                                            child: orderdetailController
                                                        .orderdetailsinfo
                                                        ?.orderdata
                                                        .flowId ==
                                                    "0"
                                                ? InkWell(
                                                    onTap: () {
                                                      setState(() {
                                                        orderdetailController
                                                            .orderdetailslist(
                                                                oid:
                                                                    widget.oid);
                                                        assignriderController
                                                            .mackdisitionlist(
                                                                oid:
                                                                    widget.oid);
                                                      });
                                                    },
                                                    child: Container(
                                                        height: 50,
                                                        width: Get.width * 0.45,
                                                        alignment: Alignment
                                                            .center,
                                                        decoration: BoxDecoration(
                                                            borderRadius:
                                                                BorderRadius
                                                                    .circular(
                                                                        12),
                                                            gradient: gradient
                                                                .btnGradient),
                                                        child: Text(
                                                            "Accept",
                                                            style: TextStyle(
                                                                fontFamily:
                                                                    FontFamily
                                                                        .gilroyBold,
                                                                color:
                                                                    WhiteColor,
                                                                fontSize: 16))),
                                                  )
                                                : InkWell(
                                                    onTap: () {
                                                      bottomsheet();
                                                    },
                                                    child: Container(
                                                        height: 50,
                                                        width: Get.width * 0.45,
                                                        alignment: Alignment
                                                            .center,
                                                        decoration: BoxDecoration(
                                                            borderRadius:
                                                                BorderRadius
                                                                    .circular(
                                                                        12),
                                                            gradient: gradient
                                                                .btnGradient),
                                                        child: Text(
                                                            "Reassign",
                                                            style: TextStyle(
                                                                fontFamily:
                                                                    FontFamily
                                                                        .gilroyBold,
                                                                color:
                                                                    WhiteColor,
                                                                fontSize: 16))),
                                                  ));
                                      })
                                    ],
                                  ),
                                ),
                              )
                            : SizedBox()
                    : SizedBox()
            : SizedBox();
      }),
      appBar: AppBar(
        leading: BackButton(color: BlackColor),
        title: Text(
          "Order ID: #${widget.oid}",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            color: BlackColor,
            fontSize: 17,
          ),
        ),
        elevation: 0,
        backgroundColor: WhiteColor,
      ),
      body: RefreshIndicator(
        color: greenColor,
        onRefresh: () {
          return Future.delayed(
            Duration(seconds: 2),
            () {
              setState(() {
                orderdetailController.orderdetailslist(oid: widget.oid);
              });
            },
          );
        },
        child: SingleChildScrollView(
          physics: BouncingScrollPhysics(),
          child: GetBuilder<OrderdetailController>(builder: (context) {
            return Padding(
              padding: const EdgeInsets.symmetric(horizontal: 12),
              child: orderdetailController.isLoading
                  ? Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        SizedBox(height: Get.height * 0.02),
                        orderdetailController.orderdetailsinfo!.orderdata
                                .orderProducts.isNotEmpty
                            ? Container(
                                padding: EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 12),
                                decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(5),
                                    color: WhiteColor),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      "Product Info".tr,
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        fontSize: 14,
                                        color: greenColor,
                                      ),
                                    ),
                                    SizedBox(
                                      height: 5,
                                    ),
                                    SizedBox(
                                      height: 120,
                                      width: double.infinity,
                                      child: ListView.builder(
                                        scrollDirection: Axis.horizontal,
                                        shrinkWrap: true,
                                        itemCount: orderdetailController
                                            .orderdetailsinfo
                                            ?.orderdata
                                            .orderProducts
                                            .length,
                                        padding: EdgeInsets.zero,
                                        itemBuilder: (context, index) {
                                          return InkWell(
                                            onTap: () {
                                              orderdetailController
                                                  .changeIndexProductWise(
                                                      index: index);
                                            },
                                            child: Container(
                                              alignment: Alignment.center,
                                              margin: EdgeInsets.all(5),
                                              child: Column(
                                                children: [
                                                  Container(
                                                    height: 80,
                                                    width: 100,
                                                    padding: EdgeInsets.all(5),
                                                    alignment: Alignment.center,
                                                    child: ClipRRect(
                                                      borderRadius:
                                                          BorderRadius.circular(
                                                              5),
                                                      child: FadeInImage
                                                          .assetNetwork(
                                                        placeholder:
                                                            "assets/ezgif.com-crop.gif",
                                                        placeholderCacheHeight:
                                                            80,
                                                        placeholderCacheWidth:
                                                            100,
                                                        placeholderFit:
                                                            BoxFit.cover,
                                                        image:
                                                            "${AppUrl.imageurl}${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[index].productImage}",
                                                        height: 80,
                                                        width: 100,
                                                        fit: BoxFit.cover,
                                                      ),
                                                    ),
                                                  ),
                                                  SizedBox(
                                                    width: 100,
                                                    child: Text(
                                                      "${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[index].productName}",
                                                      maxLines: 2,
                                                      textAlign:
                                                          TextAlign.center,
                                                      style: TextStyle(
                                                        fontFamily: FontFamily
                                                            .gilroyBold,
                                                        color: greyColor,
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        fontSize: 10,
                                                      ),
                                                    ),
                                                  ),
                                                ],
                                              ),
                                              decoration: BoxDecoration(
                                                border: orderdetailController
                                                            .currentIndex ==
                                                        index
                                                    ? Border.all(
                                                        color: greenColor)
                                                    : Border.all(
                                                        color: Colors
                                                            .grey.shade300),
                                                // color: myOrderController
                                                //             .currentIndex ==
                                                //         index
                                                //     ? Color(0xffdaedfd)
                                                //     : WhiteColor,
                                                color: WhiteColor,
                                                borderRadius:
                                                    BorderRadius.circular(7),
                                              ),
                                            ),
                                          );
                                        },
                                      ),
                                    ),
                                  ],
                                ),
                              )
                            : SizedBox(),
                        SizedBox(height: Get.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Item Info".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Price".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${currency}${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[orderdetailController.currentIndex].productPrice}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          "Total".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${currency}${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[orderdetailController.currentIndex].productPrice}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Variation".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[orderdetailController.currentIndex].productType}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                  Expanded(
                                    child: Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          "Qty".tr,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 2,
                                        ),
                                        Text(
                                          ":",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 13,
                                            color: greyColor,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          "${orderdetailController.orderdetailsinfo?.orderdata.orderProducts[orderdetailController.currentIndex].productQuantity}",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          ),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(5),
                            color: WhiteColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        Container(
                          padding: EdgeInsets.symmetric(
                              horizontal: 12, vertical: 12),
                          width: Get.size.width,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "Order Info".tr,
                                style: TextStyle(
                                  fontFamily: FontFamily.gilroyBold,
                                  fontSize: 14,
                                  color: greenColor,
                                ),
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Subtotal".tr,
                                subtitle:
                                    "${currency}${orderdetailController.orderdetailsinfo?.orderdata.orderSubTotal}",
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Delivery Charge".tr,
                                subtitle:
                                    "${currency}${orderdetailController.orderdetailsinfo?.orderdata.deliveryCharge}",
                              ),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Store Charge".tr,
                                subtitle:
                                    "${currency}${orderdetailController.orderdetailsinfo?.orderdata.storeCharge}",
                              ),
                              orderdetailController.orderdetailsinfo?.orderdata
                                          .couponAmount !=
                                      "0"
                                  ? SizedBox(
                                      height: 13,
                                    )
                                  : SizedBox(),
                              orderdetailController.orderdetailsinfo?.orderdata
                                          .couponAmount !=
                                      "0"
                                  ? OrderInfo(
                                      title: "Coupon Amount".tr,
                                      subtitle:
                                          "${currency}${orderdetailController.orderdetailsinfo?.orderdata.couponAmount}",
                                    )
                                  : SizedBox(),
                              orderdetailController.orderdetailsinfo?.orderdata
                                          .wallAmt !=
                                      "0"
                                  ? SizedBox(
                                      height: 13,
                                    )
                                  : SizedBox(),
                              orderdetailController.orderdetailsinfo?.orderdata
                                          .wallAmt !=
                                      "0"
                                  ? OrderInfo(
                                      title: "Wallet Amount".tr,
                                      subtitle:
                                          "${currency}${orderdetailController.orderdetailsinfo?.orderdata.wallAmt}",
                                    )
                                  : SizedBox(),
                              SizedBox(
                                height: 13,
                              ),
                              OrderInfo(
                                title: "Total".tr,
                                subtitle:
                                    "${currency}${orderdetailController.orderdetailsinfo?.orderdata.orderTotal}",
                              ),
                              SizedBox(
                                height: 2,
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.start,
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Text(
                                    "Payment Method".tr,
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 2,
                                  ),
                                  Text(
                                    ":",
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 5,
                                  ),
                                  SizedBox(
                                    width: Get.size.width * 0.45,
                                    height: 35,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          orderdetailController.orderdetailsinfo
                                                  ?.orderdata.pMethodName ??
                                              "",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        ),
                                        Text(
                                          "(${orderdetailController.orderdetailsinfo?.orderdata.orderTransactionId})",
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                          ),
                                        )
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              // myOrderController.nDetailsInfo?.orderProductList
                              //             .deliveryTimeslot !=
                              //         "0"
                              //     ?
                              OrderInfo(
                                title: "Delivery time".tr,
                                subtitle: orderdetailController.orderdetailsinfo
                                    ?.orderdata.deliveryTimeslot,
                              ),
                              // : SizedBox(),
                              SizedBox(
                                height: 10,
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.start,
                                crossAxisAlignment: CrossAxisAlignment.center,
                                children: [
                                  Text(
                                    "Address".tr,
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 2,
                                  ),
                                  Text(
                                    ":",
                                    style: TextStyle(
                                      fontFamily: FontFamily.gilroyBold,
                                      fontSize: 13,
                                      color: greyColor,
                                    ),
                                  ),
                                  SizedBox(
                                    width: 5,
                                  ),
                                  SizedBox(
                                    width: Get.size.width * 0.72,
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Text(
                                          orderdetailController.orderdetailsinfo
                                                  ?.orderdata.customerAddress ??
                                              "",
                                          maxLines: 3,
                                          style: TextStyle(
                                            fontFamily: FontFamily.gilroyBold,
                                            fontSize: 14,
                                            color: Colors.grey,
                                            overflow: TextOverflow.ellipsis,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              orderdetailController.orderdetailsinfo?.orderdata
                                          .orderStatus ==
                                      "Cancelled"
                                  ? OrderInfo(
                                      title: "Cancel Comment".tr,
                                      subtitle: orderdetailController
                                          .orderdetailsinfo
                                          ?.orderdata
                                          .commentReject,
                                    )
                                  : SizedBox(),
                            ],
                          ),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(5),
                            color: WhiteColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        orderdetailController.orderdetailsinfo?.orderdata
                                    .additionalNote !=
                                ""
                            ? Container(
                                padding: EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 12),
                                width: Get.size.width,
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      "Addition Note".tr,
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        color: greenColor,
                                        fontSize: 14,
                                      ),
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),
                                    Text(
                                      orderdetailController.orderdetailsinfo
                                              ?.orderdata.additionalNote ??
                                          "",
                                      style: TextStyle(
                                        fontFamily: FontFamily.gilroyBold,
                                        color: Colors.grey,
                                        fontSize: 14,
                                      ),
                                    ),
                                  ],
                                ),
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(5),
                                  color: WhiteColor,
                                ),
                              )
                            : SizedBox()
                      ],
                    )
                  : SizedBox(
                      height: Get.height,
                      width: Get.width,
                      child: Center(
                        child: CircularProgressIndicator(
                          color: greenColor,
                        ),
                      ),
                    ),
            );
          }),
        ),
      ),
    );
  }

  Paymentinfo({String? text, infotext}) {
    return Column(
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(
              text!,
              style: TextStyle(
                fontFamily: FontFamily.gilroyMedium,
                color: Colors.grey.shade400,
                fontSize: 14,
              ),
            ),
            Text(
              infotext,
              style: TextStyle(
                fontFamily: FontFamily.gilroyBold,
                color: BlackColor,
                fontSize: 15,
              ),
            ),
          ],
        ),
        SizedBox(height: Get.height * 0.015),
      ],
    );
  }

  OrderInfo({String? title, subtitle}) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.start,
      children: [
        Text(
          title ?? "",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 13,
            color: greyColor,
          ),
        ),
        SizedBox(
          width: 2,
        ),
        Text(
          ":",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 13,
            color: greyColor,
          ),
        ),
        SizedBox(
          width: 5,
        ),
        Text(
          subtitle ?? "",
          style: TextStyle(
            fontFamily: FontFamily.gilroyBold,
            fontSize: 14,
            color: Colors.grey,
          ),
        )
      ],
    );
  }

  bgdecoration({Widget? child, EdgeInsetsGeometry? margin}) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
      margin: margin,
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(12),
          border: Border.all(color: Colors.grey.shade300)),
      child: child,
    );
  }

  bottomsheet() {
    return showModalBottomSheet(
        backgroundColor: WhiteColor,
        isScrollControlled: true,
        context: context,
        shape: const RoundedRectangleBorder(
            borderRadius: BorderRadius.only(
                topLeft: Radius.circular(15), topRight: Radius.circular(15))),
        builder: (context) {
          return StatefulBuilder(
              builder: (BuildContext context, StateSetter setState) {
            return Container(
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(15),
                  border: Border.all(color: Colors.grey.shade300)),
              padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
              height: Get.height * 0.25,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text("Delivery Boy List",
                      style: TextStyle(
                          fontFamily: FontFamily.gilroyMedium,
                          color: greyColor,
                          fontSize: 16)),
                  SizedBox(height: Get.height * 0.015),
                  Container(
                    height: 60,
                    width: Get.size.width,
                    alignment: Alignment.center,
                    padding: EdgeInsets.only(left: 15, right: 15),
                    child: DropdownButton(
                      value: slectStatus,
                      hint: Text("Select assign dilevry boy"),
                      icon: Image.asset(
                        'assets/Arrowdown.png',
                        height: 20,
                        width: 20,
                      ),
                      isExpanded: true,
                      underline: SizedBox.shrink(),
                      items: riderlistController.ridertitle
                          .map<DropdownMenuItem<String>>((String value) {
                        return DropdownMenuItem<String>(
                          value: value,
                          child: Text(
                            value,
                            style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              color: BlackColor,
                              fontSize: 14,
                            ),
                          ),
                        );
                      }).toList(),
                      onChanged: (value) {
                        for (var i = 0;
                            i < riderlistController.riderinfo!.riderdata.length;
                            i++) {
                          if (value ==
                              riderlistController
                                  .riderinfo?.riderdata[i].title) {
                            addRiderController.pType = riderlistController
                                    .riderinfo?.riderdata[i].id ??
                                "";
                          }
                        }
                        // if (value == "Publish") {
                        //   addmedicineController.status = "1";
                        // } else if (value == "UnPublish") {
                        //   addmedicineController.status = "0";
                        // }
                        setState(() {
                          slectStatus = value ?? "";
                          // listOfUser.add(selectValue);
                        });
                      },
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey),
                    ),
                  ),
                  SizedBox(height: Get.height * 0.03),
                  AppButton(
                    buttontext: "Assign to delivery boy",
                    onTap: () {
                      assignriderController.assignriderlist(
                          oid: widget.oid, rid: addRiderController.pType);
                      Get.back();
                      Dialogbox();
                    },
                  )
                ],
              ),
            );
          });
        });
  }

  Future Dialogbox() {
    return Get.defaultDialog(
      title: "",
      content: WillPopScope(
        onWillPop: () async {
          return false;
        },
        child: Container(
          height: Get.height * 0.42,
          width: Get.size.width,
          child: Column(
            children: [
              Image.asset(
                "assets/successfull.png",
                height: 150,
                width: 150,
              ),
              Padding(
                  padding: const EdgeInsets.only(left: 15),
                  child: orderdetailController
                              .orderdetailsinfo?.orderdata.orderType ==
                          "Self"
                      ? Text(
                          "Delivery Successfully!".tr,
                          style: TextStyle(
                            color: greenColor,
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 20,
                          ),
                        )
                      : Text(
                          "Assign Successfully!".tr,
                          style: TextStyle(
                            color: greenColor,
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 20,
                          ),
                        )),
              SizedBox(
                height: 20,
              ),
              Text(
                "You’re successfully sent the request",
                maxLines: 3,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontFamily: FontFamily.gilroyMedium,
                  fontSize: 15,
                  color: BlackColor,
                ),
              ),
              SizedBox(
                height: 20,
              ),
              InkWell(
                onTap: () {
                  // couponCode = "";
                  // couponController.couponMsg = "";
                  // homePageController.getHomeDataApi(
                  //   countryId: getData.read("countryId"),
                  // );
                  // homePageController.getCatWiseData(
                  //   cId: "0",
                  //   countryId: getData.read("countryId"),
                  // );
                  // reviewSummaryController.cleanOtherDetails();
                  Get.back();
                  Get.to(() => BottoBarScreen());
                },
                child: Container(
                  height: 60,
                  margin: EdgeInsets.all(15),
                  alignment: Alignment.center,
                  child: Text(
                    "Home".tr,
                    style: TextStyle(
                      color: WhiteColor,
                      fontFamily: FontFamily.gilroyBold,
                      fontSize: 16,
                    ),
                  ),
                  decoration: BoxDecoration(
                    gradient: gradient.btnGradient,
                    borderRadius: BorderRadius.circular(45),
                  ),
                ),
              ),
            ],
          ),
          decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(40), color: WhiteColor),
        ),
      ),
    );
  }
}
