// ignore_for_file: prefer_const_constructors, sort_child_properties_last, prefer_const_literals_to_create_immutables, non_constant_identifier_names, unused_element, prefer_typing_uninitialized_variables, prefer_interpolation_to_compose_strings, avoid_print, deprecated_member_use, unused_field, file_names, must_be_immutable

import 'dart:convert';
import 'dart:io';

import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:storeappnew/Controller_class/Add_product_controller.dart';
import 'package:storeappnew/Controller_class/Category_Controller.dart';
import 'package:storeappnew/api_screens/Api_werper.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class AddMedicine extends StatefulWidget {
  String? add;
  String? recordid;
  String? categoryname;
  String? categoryid;
  AddMedicine(
      {this.add, this.recordid, this.categoryid, this.categoryname, super.key});

  @override
  State<AddMedicine> createState() => _AddMedicineState();
}

List<String> list = ["Yes", "No"];
List<String> propartyStatus = ["Publish", "UnPublish"];
List<String> category = ["fevar"];

class _AddMedicineState extends State<AddMedicine> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  AddmedicineController addmedicineController =
      Get.put(AddmedicineController());
  CategoryController categoryController = Get.put(CategoryController());

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
        addmedicineController.emptyAllDetails();
        addmedicineController.medicineImage = addmedicineController.Editimage;
        addmedicineController.MedicineTitle.text =
            addmedicineController.Edittitle;
        addmedicineController.description.text =
            addmedicineController.EditDescription;
        addmedicineController.pType = widget.categoryid ?? "";
        selectProperty = widget.categoryname ?? "";
      });
    } else {
      addmedicineController.emptyAllDetails();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: appbar(title: "Add Product"),
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
              print("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!${widget.recordid}");
              if (_formKey.currentState?.validate() ?? false) {
                if (selectProperty != null) {
                  if (addmedicineController.path != null ||
                      addmedicineController.medicineImage != "") {
                    if (widget.add == "Add") {
                      addmedicineController.addmedicine();
                    }
                    if (widget.add == "edit") {
                      addmedicineController.updatemedicine(
                          recordid: widget.recordid);
                    }
                  } else {
                    ApiWrapper.showToastMessage("Please Upload Image".tr);
                  }
                } else {
                  ApiWrapper.showToastMessage("Please  Select Category".tr);
                }
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
                                      child: addmedicineController.path == null
                                          ? Image.asset(
                                              "assets/uplodeimage.png",
                                              height: 40,
                                              width: 42,
                                            )
                                          : Image.file(
                                              File(
                                                addmedicineController.path
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
                                      child: addmedicineController
                                                  .medicineImage ==
                                              ""
                                          ? Image.asset(
                                              "assets/uplodeimage.png",
                                              height: 40,
                                              width: 42,
                                            )
                                          : addmedicineController.path == null
                                              ? Image.network(
                                                  "${AppUrl.imageurl}${addmedicineController.medicineImage}",
                                                  height: 50,
                                                  width: 50,
                                                  fit: BoxFit.cover,
                                                )
                                              : Image.file(
                                                  File(
                                                    addmedicineController.path
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
                        SizedBox(height: Get.height * 0.01),
                        textfield(
                          type: "Product Title".tr,
                          controller: addmedicineController.MedicineTitle,
                          labelText: "Enter Product Title".tr,
                          validator: (value) {
                            if (value == null || value.isEmpty) {
                              return 'Please Enter Product Title'.tr;
                            }
                            return null;
                          },
                        ),

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
                        // widget.add == "edit"
                        //     ?
                        Container(
                          height: 60,
                          width: Get.size.width,
                          alignment: Alignment.center,
                          padding: EdgeInsets.only(left: 15, right: 15),
                          child: DropdownButton(
                            hint: Text(
                              // "${widget.categoryname}",
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
                            items: categoryController.categorytext
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
                                      categoryController
                                          .categoryinfo!.categorydata.length;
                                  i++) {
                                if (value ==
                                    categoryController
                                        .categoryinfo?.categorydata[i].title) {
                                  addmedicineController.pType =
                                      categoryController.categoryinfo
                                              ?.categorydata[i].id ??
                                          "";
                                }
                              }
                              setState(() {
                                selectProperty = value;
                              });
                            },
                          ),
                          decoration: BoxDecoration(
                            color: WhiteColor,
                            borderRadius: BorderRadius.circular(15),
                            border: Border.all(color: Colors.grey.shade200),
                          ),
                        ),

                        SizedBox(height: Get.height * 0.015),
                        Text(
                          "Product Description".tr,
                          style: TextStyle(
                            fontFamily: FontFamily.gilroyBold,
                            fontSize: 16,
                            color: BlackColor,
                          ),
                        ),
                        SizedBox(height: Get.height * 0.01),
                        Container(
                          child: TextFormField(
                            controller: addmedicineController.description,
                            minLines: 5,
                            keyboardType: TextInputType.multiline,
                            maxLines: null,
                            cursorColor: BlackColor,
                            autovalidateMode:
                                AutovalidateMode.onUserInteraction,
                            decoration: InputDecoration(
                              focusedBorder: OutlineInputBorder(
                                borderSide: BorderSide(color: greenColor),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              contentPadding: EdgeInsets.all(10),
                              border: InputBorder.none,
                              hintText: "Description".tr,
                              hintStyle: TextStyle(
                                fontFamily: FontFamily.gilroyMedium,
                                fontSize: 15,
                              ),
                            ),
                            style: TextStyle(
                              fontFamily: FontFamily.gilroyMedium,
                              fontSize: 16,
                              color: BlackColor,
                            ),
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please Enter Product Description'.tr;
                              }
                              return null;
                            },
                          ),
                          decoration: BoxDecoration(
                            color: WhiteColor,
                            borderRadius: BorderRadius.circular(15),
                            border: Border.all(color: Colors.grey.shade200),
                          ),
                        ),
                        SizedBox(height: Get.height * 0.012),
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
                                addmedicineController.status = "1";
                              } else if (value == "UnPublish") {
                                addmedicineController.status = "0";
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
      addmedicineController.path = pickedFile.path;
      setState(() {});
      File imageFile = File(addmedicineController.path.toString());
      List<int> imageBytes = imageFile.readAsBytesSync();
      addmedicineController.base64Image = base64Encode(imageBytes);
      print("!!!!!!!!!++++++++++++${addmedicineController.base64Image}");
      setState(() {});
    }
  }
}
