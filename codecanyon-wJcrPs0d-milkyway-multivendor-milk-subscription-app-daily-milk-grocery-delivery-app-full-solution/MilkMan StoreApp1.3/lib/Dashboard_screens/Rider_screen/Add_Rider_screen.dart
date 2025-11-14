// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, non_constant_identifier_names, unused_element, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, avoid_print, deprecated_member_use, unused_field, must_be_immutable, file_names

import 'dart:convert';
import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:storeappnew/Controller_class/Addrider_controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddRiderScreen extends StatefulWidget {
  String? add;
  String? recordid;
  AddRiderScreen({this.add, this.recordid, super.key});

  @override
  State<AddRiderScreen> createState() => _AddRiderScreenState();
}

List<String> list = ["Yes", "No"];
List<String> propartyStatus = ["Publish", "UnPublish"];
List<String> category = ["fevar"];

class _AddRiderScreenState extends State<AddRiderScreen> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  AddRiderController addRiderController = Get.put(AddRiderController());

  String selectValue = list.first;
  String fevar = category.first;
  String? selectProperty;
  String? selectCountry;
  String slectStatus = propartyStatus.first;

  bool carCheck = false;
  bool sportCheck = false;
  bool laundaryCheck = false;

  @override
  void initState() {
    super.initState();
    if (widget.add == "edit") {
      setState(() {
        addRiderController.emptyAllDetails();
        addRiderController.Ridername.text = addRiderController.Edittitle;
        addRiderController.Rideremail.text = addRiderController.Editemail;
        addRiderController.Ridercountrycode.text = addRiderController.Editccode;
        addRiderController.Ridermobile.text = addRiderController.Editmobile;
        addRiderController.Riderpassword.text = addRiderController.Editpassword;
        addRiderController.couponImage = addRiderController.Editimage;
      });
    } else {
      addRiderController.emptyAllDetails();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Rider"),
      backgroundColor: WhiteColor,
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
                if (addRiderController.path != null ||
                    addRiderController.couponImage != "") {
                  if (widget.add == "Add") {
                    addRiderController.addrider();
                  } else if (widget.add == "edit") {
                    addRiderController.updaterider(recordid: widget.recordid);
                  } else {
                    ApiWrapper.showToastMessage("Please Upload Image".tr);
                  }
                }
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: GetBuilder<AddRiderController>(builder: (context) {
          return Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Expanded(
                child: SingleChildScrollView(
                  physics: BouncingScrollPhysics(),
                  child: Container(
                    child: Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 14),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          SizedBox(height: Get.height * 0.02),
                          Text(
                            "Rider Profile Image".tr,
                            style: TextStyle(
                              fontFamily: FontFamily.gilroyBold,
                              fontSize: 16,
                              color: BlackColor,
                            ),
                          ),
                          SizedBox(height: Get.height * 0.015),
                          DottedBorder(
                            borderType: BorderType.RRect,
                            color: greenColor,
                            radius: Radius.circular(15),
                            child: InkWell(
                              onTap: _openGallery,
                              child: ClipRRect(
                                borderRadius: BorderRadius.circular(15),
                                child: widget.add == "Add"
                                    ? Container(
                                        height: 80,
                                        margin: EdgeInsets.symmetric(
                                            horizontal: 20),
                                        width: Get.size.width,
                                        alignment: Alignment.center,
                                        child: addRiderController.path == null
                                            ? Image.asset(
                                                "assets/uplodeimage.png",
                                                height: 40,
                                                width: 42,
                                              )
                                            : Image.file(
                                                File(
                                                  addRiderController.path
                                                      .toString(),
                                                ),
                                                height: 50,
                                                width: 50,
                                                fit: BoxFit.cover,
                                              ),
                                        decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(15),
                                        ),
                                      )
                                    : Container(
                                        height: 80,
                                        margin: EdgeInsets.symmetric(
                                            horizontal: 20),
                                        width: Get.size.width,
                                        alignment: Alignment.center,
                                        child: addRiderController.couponImage ==
                                                ""
                                            ? Image.asset(
                                                "assets/uplodeimage.png",
                                                height: 40,
                                                width: 42,
                                              )
                                            : addRiderController.path == null
                                                ? Image.network(
                                                    "${AppUrl.imageurl}${addRiderController.couponImage}",
                                                    height: 50,
                                                    width: 50,
                                                    fit: BoxFit.cover,
                                                  )
                                                : Image.file(
                                                    File(
                                                      addRiderController.path
                                                          .toString(),
                                                    ),
                                                    height: 50,
                                                    width: 50,
                                                    fit: BoxFit.cover,
                                                  ),
                                        decoration: BoxDecoration(
                                          borderRadius:
                                              BorderRadius.circular(15),
                                        ),
                                      ),
                              ),
                            ),
                          ),
                          SizedBox(height: Get.height * 0.01),
                          textfield(
                            type: "Rider Name".tr,
                            controller: addRiderController.Ridername,
                            labelText: "Enter Rider Name".tr,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Rider Name'.tr;
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: Get.height * 0.01),
                          textfield(
                            type: "Rider email".tr,
                            controller: addRiderController.Rideremail,
                            labelText: "Enter Rider email".tr,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Rider email'.tr;
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: Get.height * 0.01),
                          textfield(
                            type: "Rider Country Code".tr,
                            controller: addRiderController.Ridercountrycode,
                            labelText: "Enter Rider Country Code".tr,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Rider Country Code'.tr;
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: Get.height * 0.01),
                          textfield(
                            type: "Rider Mobile".tr,
                            controller: addRiderController.Ridermobile,
                            textInputType: TextInputType.number,
                            labelText: "Enter Rider Mobile".tr,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Rider Mobile'.tr;
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: Get.height * 0.01),
                          textfield(
                            type: "Rider password".tr,
                            controller: addRiderController.Riderpassword,
                            labelText: "Enter Rider password".tr,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Rider password'.tr;
                              }
                              return null;
                            },
                          ),
                          SizedBox(height: Get.height * 0.015),
                          Text(
                            "Rider Status".tr,
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
                              value: slectStatus,
                              icon: Image.asset(
                                'assets/Arrowdown.png',
                                height: 20,
                                width: 20,
                              ),
                              isExpanded: true,
                              underline: SizedBox.shrink(),
                              items: propartyStatus
                                  .map<DropdownMenuItem<String>>(
                                      (String value) {
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
                                if (value == "Publish") {
                                  addRiderController.status = "1";
                                } else if (value == "UnPublish") {
                                  addRiderController.status = "0";
                                }
                                setState(() {
                                  slectStatus = value ?? "";
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
                          SizedBox(height: 25),
                        ],
                      ),
                    ),
                    decoration: BoxDecoration(
                      color: WhiteColor,
                    ),
                  ),
                ),
              ),
            ],
          );
        }),
      ),
    );
  }

  void _openGallery() async {
    final pickedFile =
        await ImagePicker().getImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      addRiderController.path = pickedFile.path;
      setState(() {});
      File imageFile = File(addRiderController.path.toString());
      List<int> imageBytes = imageFile.readAsBytesSync();
      addRiderController.base64Image = base64Encode(imageBytes);
      print("!!!!!!!!!++++++++++++${addRiderController.base64Image}");
      setState(() {});
    }
  }
}
