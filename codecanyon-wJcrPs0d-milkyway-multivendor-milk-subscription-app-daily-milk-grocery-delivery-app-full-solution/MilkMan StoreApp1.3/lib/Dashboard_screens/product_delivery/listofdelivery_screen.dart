// ignore_for_file: sort_child_properties_last, prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/adddelivery_controller.dart';
import 'package:storeappnew/Dashboard_screens/product_delivery/adddelivery_screen.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class ListOfDeliveryScreen extends StatefulWidget {
  const ListOfDeliveryScreen({super.key});

  @override
  State<ListOfDeliveryScreen> createState() => _ListOfDeliveryScreenState();
}

class _ListOfDeliveryScreenState extends State<ListOfDeliveryScreen> {
  AddDeliveryController addDeliveryController =
      Get.put(AddDeliveryController());

  @override
  void initState() {
    addDeliveryController.getDeliveryList();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
        onTap: () {
          Get.to(
            () => AddDeliveryScreen(
              add: "Add",
            ),
          );
        },
        title: "Add Deliveries",
      ),
      body: GetBuilder<AddDeliveryController>(builder: (context) {
        return addDeliveryController.isLoading
            ? Padding(
                padding: const EdgeInsets.symmetric(horizontal: 10),
                child: Column(
                  children: [
                    SizedBox(
                      height: 7,
                    ),
                    Expanded(
                      child: ListView.builder(
                        itemCount: addDeliveryController.deliveryInfo.length,
                        shrinkWrap: true,
                        physics: BouncingScrollPhysics(),
                        itemBuilder: (context, index) {
                          return Stack(
                            children: [
                              Container(
                                height: 70,
                                width: Get.size.width,
                                margin: EdgeInsets.all(10),
                                child: Row(
                                  children: [
                                    SizedBox(
                                      width: 10,
                                    ),
                                    Container(
                                      height: 50,
                                      width: 50,
                                      padding: EdgeInsets.all(13),
                                      alignment: Alignment.center,
                                      child: Image.asset(
                                          "assets/documentlist.png"),
                                      decoration: BoxDecoration(
                                          gradient: gradient.btnGradient,
                                          borderRadius:
                                              BorderRadius.circular(10)),
                                    ),
                                    SizedBox(
                                      width: 8,
                                    ),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          Text(
                                            addDeliveryController
                                                .deliveryInfo[index].title,
                                            maxLines: 1,
                                            style: TextStyle(
                                              fontFamily: FontFamily.gilroyBold,
                                              fontSize: 16,
                                              color: BlackColor,
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                          addDeliveryController
                                                      .deliveryInfo[index]
                                                      .status ==
                                                  "0"
                                              ? Text(
                                                  "UnPublish",
                                                  style: TextStyle(
                                                    color: greycolor,
                                                    fontFamily:
                                                        FontFamily.gilroyMedium,
                                                    fontSize: 14,
                                                  ),
                                                )
                                              : Text(
                                                  "Publish",
                                                  style: TextStyle(
                                                    color: greyColor,
                                                    fontFamily:
                                                        FontFamily.gilroyMedium,
                                                    fontSize: 14,
                                                  ),
                                                ),
                                        ],
                                      ),
                                    ),
                                  ],
                                ),
                                decoration: BoxDecoration(
                                  border:
                                      Border.all(color: Colors.grey.shade300),
                                  color: WhiteColor,
                                  borderRadius: BorderRadius.circular(15),
                                ),
                              ),
                              Positioned(
                                top: 0,
                                right: 0,
                                child: InkWell(
                                    onTap: () {
                                      addDeliveryController
                                          .getValueInDeliveryList(
                                        reId: addDeliveryController
                                            .deliveryInfo[index].id,
                                        deliveryTitle: addDeliveryController
                                            .deliveryInfo[index].title,
                                        deliveryDigit: addDeliveryController
                                            .deliveryInfo[index].deDigit,
                                        status1: addDeliveryController
                                            .deliveryInfo[index].status,
                                      );
                                      Get.to(
                                        (() => AddDeliveryScreen(
                                              add: "edit",
                                              deliveryStatus:
                                                  addDeliveryController
                                                              .deliveryInfo[
                                                                  index]
                                                              .status ==
                                                          "1"
                                                      ? "Publish"
                                                      : "UnPublish",
                                            )),
                                      );
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
                            ],
                          );
                        },
                      ),
                    ),
                  ],
                ),
              )
            : Center(
                child: CircularProgressIndicator(
                  color: greenColor,
                ),
              );
      }),
    );
  }
}
