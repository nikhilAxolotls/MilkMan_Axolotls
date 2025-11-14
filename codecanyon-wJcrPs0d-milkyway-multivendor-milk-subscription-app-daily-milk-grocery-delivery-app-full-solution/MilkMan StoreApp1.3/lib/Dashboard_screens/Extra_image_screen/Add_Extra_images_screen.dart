// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, non_constant_identifier_names, unused_element, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, avoid_print, deprecated_member_use, unused_field, file_names, must_be_immutable

import 'dart:convert';
import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:storeappnew/Controller_class/Add_extra_image_controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddExtraimageScreen extends StatefulWidget {
  String? add;
  String? pID;
  String? pName;
  AddExtraimageScreen({this.add, this.pID, this.pName, super.key});

  @override
  State<AddExtraimageScreen> createState() => _AddExtraimageScreenState();
}

List<String> propartyStatus = ["Publish", "UnPublish"];

class _AddExtraimageScreenState extends State<AddExtraimageScreen> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  AddExtraimageController addExtraimageController =
      Get.put(AddExtraimageController());
  MymedicineController mymedicineController = Get.put(MymedicineController());

  String? selectProperty;

  String slectStatus = propartyStatus.first;

  bool carCheck = false;
  bool sportCheck = false;
  bool laundaryCheck = false;

  @override
  void initState() {
    mymedicineController.mymedicine();
    super.initState();
    if (widget.add == "edit") {
      setState(() {
        addExtraimageController.medicineImage = "";
        addExtraimageController.medicineImage = addExtraimageController.mid;
        addExtraimageController.pType = widget.pID ?? "";
        selectProperty = widget.pName ?? "";
      });
    } else if (widget.add == "Add") {
      setState(() {
        addExtraimageController.mid = "";
        addExtraimageController.medicineImage = "";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    // notifire = Provider.of<ColorNotifire>(context, listen: true);
    return Scaffold(
      appBar: appbar(title: "Add Extra images"),
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
              print(">>>>>>>>>>>>>selectProperty<<<<<<<<<<<<<<$selectProperty");
              if (selectProperty != null) {
                if (addExtraimageController.path != null ||
                    addExtraimageController.medicineImage != "") {
                  if (widget.add == "Add") {
                    addExtraimageController.addextraimage();
                  }
                  if (widget.add == "edit") {
                    addExtraimageController.editExtraimage();
                  }
                } else {
                  ApiWrapper.showToastMessage("Please Upload Image");
                }
              } else {
                ApiWrapper.showToastMessage("Please Select Category");
              }
            }),
      ),
      body: Form(
        key: _formKey,
        child: Column(
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
                          "Product Category?".tr,
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
                                "Select Category",
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
                                for (var i = 0;
                                    i <
                                        mymedicineController
                                            .medicinedata!.productdata.length;
                                    i++) {
                                  if (value ==
                                      mymedicineController
                                          .medicinedata!.productdata[i].title) {
                                    addExtraimageController.pType =
                                        mymedicineController
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
                        Text(
                          "Product Image".tr,
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
                          // borderPadding: EdgeInsets.symmetric(horizontal: 20),
                          child: InkWell(
                            onTap: _openGallery,
                            child: ClipRRect(
                              borderRadius: BorderRadius.circular(15),
                              child: widget.add == "Add"
                                  ? Container(
                                      height: 80,
                                      margin:
                                          EdgeInsets.symmetric(horizontal: 20),
                                      width: Get.size.width,
                                      alignment: Alignment.center,
                                      child:
                                          addExtraimageController.path == null
                                              ? Image.asset(
                                                  "assets/uplodeimage.png",
                                                  height: 40,
                                                  width: 42,
                                                )
                                              : Image.file(
                                                  File(
                                                    addExtraimageController.path
                                                        .toString(),
                                                  ),
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                ),
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(15),
                                      ),
                                    )
                                  : Container(
                                      height: 80,
                                      margin:
                                          EdgeInsets.symmetric(horizontal: 20),
                                      width: Get.size.width,
                                      alignment: Alignment.center,
                                      child: addExtraimageController
                                                  .medicineImage ==
                                              ""
                                          ? Image.asset(
                                              "assets/uplodeimage.png",
                                              height: 40,
                                              width: 42,
                                            )
                                          : addExtraimageController.path == null
                                              ? Image.network(
                                                  "${AppUrl.imageurl}${addExtraimageController.medicineImage}",
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                )
                                              : Image.file(
                                                  File(
                                                    addExtraimageController.path
                                                        .toString(),
                                                  ),
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                ),
                                      decoration: BoxDecoration(
                                        borderRadius: BorderRadius.circular(15),
                                      ),
                                    ),
                            ),
                          ),
                        ),
                        SizedBox(height: Get.height * 0.02),
                        Text(
                          "Product Status".tr,
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
                              if (value == "Publish") {
                                addExtraimageController.status = "1";
                              } else if (value == "UnPublish") {
                                addExtraimageController.status = "0";
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
        ),
      ),
    );
  }

  void _openGallery() async {
    final pickedFile =
        await ImagePicker().getImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      addExtraimageController.path = pickedFile.path;
      setState(() {});
      File imageFile = File(addExtraimageController.path.toString());
      List<int> imageBytes = imageFile.readAsBytesSync();
      addExtraimageController.base64Image = base64Encode(imageBytes);
      print("!!!!!!!!!++++++++++++${addExtraimageController.base64Image}");
      setState(() {});
    }
  }
}
