// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/attribute_controller.dart';
import 'package:storeappnew/Dashboard_screens/product_attribute/addattribute_screen.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AttributeListScreen extends StatefulWidget {
  const AttributeListScreen({super.key});

  @override
  State<AttributeListScreen> createState() => _AttributeListScreenState();
}

class _AttributeListScreenState extends State<AttributeListScreen> {
  AttributeController attributeController = Get.put(AttributeController());

  @override
  void initState() {
    attributeController.getAttributeList();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: CustomAppbar(
          onTap: () {
            Get.to(
              (() => AddAttributeScreen(
                    add: "Add",
                  )),
            );
          },
          title: "Product Attribute"),
      body: GetBuilder<AttributeController>(builder: (context) {
        return attributeController.isLoading
            ? Padding(
                padding: EdgeInsets.symmetric(horizontal: 12),
                child: Column(
                  children: [
                    SizedBox(
                      height: 7,
                    ),
                    Expanded(
                      child: ListView.builder(
                        itemCount: attributeController
                            .attriInfo?.productAttrdata.length,
                        shrinkWrap: true,
                        physics: BouncingScrollPhysics(),
                        itemBuilder: (context, index) {
                          return Stack(
                            children: [
                              Container(
                                height: 80,
                                width: Get.size.width,
                                margin: EdgeInsets.all(10),
                                child: Row(
                                  children: [
                                    SizedBox(
                                      width: 10,
                                    ),
                                    Container(
                                      height: 60,
                                      width: 60,
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
                                            attributeController
                                                    .attriInfo
                                                    ?.productAttrdata[index]
                                                    .productName ??
                                                "",
                                            maxLines: 1,
                                            style: TextStyle(
                                              fontFamily: FontFamily.gilroyBold,
                                              fontSize: 16,
                                              color: BlackColor,
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                          Text(
                                            attributeController
                                                    .attriInfo
                                                    ?.productAttrdata[index]
                                                    .title ??
                                                "",
                                            maxLines: 1,
                                            style: TextStyle(
                                              fontFamily:
                                                  FontFamily.gilroyMedium,
                                              fontSize: 14,
                                              color: greyColor,
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                          SizedBox(
                                            height: 4,
                                          ),
                                          Row(
                                            mainAxisAlignment:
                                                MainAxisAlignment.start,
                                            children: [
                                              Text(
                                                "P/Price : ",
                                                style: TextStyle(
                                                  fontSize: 12,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              ),
                                              Text(
                                                attributeController
                                                        .attriInfo
                                                        ?.productAttrdata[index]
                                                        .normalPrice ??
                                                    "",
                                                style: TextStyle(
                                                  fontSize: 12,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              ),
                                              SizedBox(
                                                width: 20,
                                              ),
                                              Text(
                                                "S/Price : ",
                                                style: TextStyle(
                                                  fontSize: 12,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              ),
                                              Text(
                                                attributeController
                                                        .attriInfo
                                                        ?.productAttrdata[index]
                                                        .subscribePrice ??
                                                    "",
                                                style: TextStyle(
                                                  fontSize: 12,
                                                  fontFamily:
                                                      FontFamily.gilroyMedium,
                                                ),
                                              ),
                                            ],
                                          ),
                                        ],
                                      ),
                                    ),
                                  ],
                                ),
                                decoration: BoxDecoration(
                                  color: WhiteColor,
                                  borderRadius: BorderRadius.circular(15),
                                  border:
                                      Border.all(color: Colors.grey.shade300),
                                ),
                              ),
                              Positioned(
                                top: 0,
                                right: 0,
                                child: InkWell(
                                    onTap: () {
                                      attributeController.getValueInAttribute(
                                        reId: attributeController.attriInfo
                                            ?.productAttrdata[index].id,
                                        proType: attributeController.attriInfo
                                            ?.productAttrdata[index].title,
                                        proDiscount: attributeController
                                            .attriInfo
                                            ?.productAttrdata[index]
                                            .discount,
                                        proPrice: attributeController
                                            .attriInfo
                                            ?.productAttrdata[index]
                                            .normalPrice,
                                        proSPrice: attributeController
                                            .attriInfo
                                            ?.productAttrdata[index]
                                            .subscribePrice,
                                        productId: attributeController.attriInfo
                                            ?.productAttrdata[index].productId,
                                      );
                                      Get.to(
                                        (() => AddAttributeScreen(
                                              add: "edit",
                                              catName: attributeController
                                                      .attriInfo
                                                      ?.productAttrdata[index]
                                                      .productName ??
                                                  "",
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
                    )
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
