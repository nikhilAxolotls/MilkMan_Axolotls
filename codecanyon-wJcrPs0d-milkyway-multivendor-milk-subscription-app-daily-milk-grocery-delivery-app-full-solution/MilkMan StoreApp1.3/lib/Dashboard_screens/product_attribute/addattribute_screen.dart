// ignore_for_file: must_be_immutable, prefer_const_constructors, sort_child_properties_last

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/Controller_class/attribute_controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddAttributeScreen extends StatefulWidget {
  String? add;
  String? catName;
  AddAttributeScreen({this.add, this.catName, super.key});

  @override
  State<AddAttributeScreen> createState() => _AddAttributeScreenState();
}

List<String> list = ["Yes", "No"];
List<String> list1 = ["Yes", "No"];

class _AddAttributeScreenState extends State<AddAttributeScreen> {
  AttributeController attributeController = Get.put(AttributeController());
  MymedicineController mymedicineController = Get.put(MymedicineController());

  String? selectProperty;
  String selectValue = list.first;
  String selectValue1 = list1.first;
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  @override
  void initState() {
    mymedicineController.mymedicine();
    super.initState();
    if (widget.add == "Add") {
      attributeController.emptyValue();
    } else if (widget.add == "edit") {
      setState(() {
        selectProperty = widget.catName ?? "";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      appBar: appbar(title: "Add Attribute"),
      bottomNavigationBar: Padding(
        padding: EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        child: GestButton(
            Width: Get.size.width,
            height: 55,
            buttoncolor: greenColor,
            buttontext: "Update".tr,
            style: TextStyle(
              fontFamily: FontFamily.gilroyBold,
              color: WhiteColor,
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
            onclick: () {
              if (_formKey.currentState?.validate() ?? false) {
                if (selectProperty != null) {
                  if (widget.add == "Add") {
                    attributeController.addAttributeInProduct();
                  } else {
                    attributeController.updateAttributeInProduct();
                  }
                } else {
                  ApiWrapper.showToastMessage("Please Select Product");
                }
              }
            }),
      ),
      body: SizedBox(
        height: Get.size.height,
        width: Get.size.width,
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(height: Get.height * 0.012),
                  Text(
                    "Select Product".tr,
                    style: TextStyle(
                      fontFamily: FontFamily.gilroyBold,
                      fontSize: 16,
                      color: BlackColor,
                    ),
                  ),
                  SizedBox(height: Get.height * 0.012),
                  GetBuilder<MymedicineController>(builder: (context) {
                    return Container(
                      height: 60,
                      width: Get.size.width,
                      alignment: Alignment.center,
                      padding: EdgeInsets.only(left: 15, right: 15),
                      child: DropdownButton(
                        hint: Text(
                          "Select Product",
                          style: TextStyle(
                            fontFamily: FontFamily.gilroyMedium,
                            color: BlackColor,
                            fontSize: 14,
                          ),
                        ),
                        value: selectProperty,
                        icon: Image.asset(
                          'assets/Arrowdown.png',
                          height: 20,
                          width: 20,
                        ),
                        isExpanded: true,
                        underline: SizedBox.shrink(),
                        items: mymedicineController.medicinelist
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
                              i <
                                  mymedicineController
                                      .medicinedata!.productdata.length;
                              i++) {
                            if (value ==
                                mymedicineController
                                    .medicinedata!.productdata[i].title) {
                              attributeController.pType = mymedicineController
                                  .medicinedata!.productdata[i].id;
                            }
                          }
                          setState(() {
                            selectProperty = value;
                            // listOfUser.add(selectValue);
                          });
                        },
                      ),
                      decoration: BoxDecoration(
                        color: WhiteColor,
                        borderRadius: BorderRadius.circular(15),
                        border: Border.all(color: Colors.grey.shade200),
                      ),
                    );
                  }),
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Product Type".tr,
                    controller: attributeController.productType,
                    labelText: "Enter Product Type".tr,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Product Type'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Product Discount".tr,
                    controller: attributeController.productDiscount,
                    labelText: "Enter Product Discount".tr,
                    textInputType: TextInputType.number,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Product Discount'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Product Price".tr,
                    controller: attributeController.productPrice,
                    labelText: "Enter Product Price".tr,
                    textInputType: TextInputType.number,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Product Price'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.02),
                  textfield(
                    type: "Product Subscription Price".tr,
                    controller: attributeController.productSPrice,
                    labelText: "Enter Product Subscription Price".tr,
                    textInputType: TextInputType.number,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please Enter Subscription Price'.tr;
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: Get.height * 0.02),
                  Text(
                    "Product Out OF Stock?".tr,
                    style: TextStyle(
                      fontFamily: FontFamily.gilroyBold,
                      fontSize: 16,
                      color: BlackColor,
                    ),
                  ),
                  SizedBox(height: Get.height * 0.012),
                  Container(
                    height: 60,
                    width: Get.size.width,
                    alignment: Alignment.center,
                    padding: EdgeInsets.only(left: 15, right: 15),
                    child: DropdownButton(
                      value: selectValue1,
                      icon: Image.asset(
                        'assets/Arrowdown.png',
                        height: 20,
                        width: 20,
                      ),
                      isExpanded: true,
                      underline: SizedBox.shrink(),
                      items:
                          list1.map<DropdownMenuItem<String>>((String value) {
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
                        if (value == "Yes") {
                          attributeController.status1 = "1";
                        } else if (value == "No") {
                          attributeController.status1 = "0";
                        }
                        setState(() {
                          selectValue1 = value ?? "";
                          // listOfUser.add(selectValue);
                        });
                      },
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey.shade200),
                    ),
                  ),
                  SizedBox(height: Get.height * 0.02),
                  Text(
                    "Subscription Required?".tr,
                    style: TextStyle(
                      fontFamily: FontFamily.gilroyBold,
                      fontSize: 16,
                      color: BlackColor,
                    ),
                  ),
                  SizedBox(height: Get.height * 0.012),
                  Container(
                    height: 60,
                    width: Get.size.width,
                    alignment: Alignment.center,
                    padding: EdgeInsets.only(left: 15, right: 15),
                    child: DropdownButton(
                      value: selectValue,
                      icon: Image.asset(
                        'assets/Arrowdown.png',
                        height: 20,
                        width: 20,
                      ),
                      isExpanded: true,
                      underline: SizedBox.shrink(),
                      items: list.map<DropdownMenuItem<String>>((String value) {
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
                        if (value == "Yes") {
                          attributeController.status = "1";
                        } else if (value == "No") {
                          attributeController.status = "0";
                        }
                        setState(() {
                          selectValue = value ?? "";
                          // listOfUser.add(selectValue);
                        });
                      },
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey.shade200),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
