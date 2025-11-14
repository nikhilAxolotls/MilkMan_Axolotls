// ignore_for_file: sort_child_properties_last, prefer_const_constructors, prefer_const_literals_to_create_immutables, unnecessary_brace_in_string_interps, file_names, avoid_print

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Add_product_controller.dart';
import 'package:storeappnew/Controller_class/My_medicine_Controller.dart';
import 'package:storeappnew/Dashboard_screens/product_screen/Add_product.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class Mymedicine extends StatefulWidget {
  const Mymedicine({super.key});

  @override
  State<Mymedicine> createState() => _MymedicineState();
}

class _MymedicineState extends State<Mymedicine> {
  @override
  void initState() {
    super.initState();
    mymedicine.mymedicine();
  }

  MymedicineController mymedicine = Get.put(MymedicineController());
  AddmedicineController addmedicineController =
      Get.put(AddmedicineController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      appBar: CustomAppbar(
        title: "My Product",
        onTap: () {
          Get.to((() => AddMedicine(
                add: "Add",
              )));
        },
      ),
      body: SafeArea(
        child: Column(
          children: [
            SizedBox(
              height: 20,
            ),
            Expanded(
              child: Container(
                padding: EdgeInsets.symmetric(horizontal: 10),
                child: GetBuilder<MymedicineController>(builder: (context) {
                  return mymedicine.isLoading
                      ? ListView.builder(
                          itemCount:
                              mymedicine.medicinedata?.productdata.length,
                          physics: BouncingScrollPhysics(),
                          itemBuilder: (context, index) {
                            return InkWell(
                              onTap: () {
                                addmedicineController.getEditDetails(
                                  ecategory: mymedicine
                                      .medicinedata?.productdata[index].catId,
                                  edescription: mymedicine.medicinedata
                                      ?.productdata[index].description,
                                  eimage: mymedicine
                                      .medicinedata?.productdata[index].img,
                                  estatus: mymedicine
                                      .medicinedata?.productdata[index].status,
                                  etitle: mymedicine
                                      .medicinedata?.productdata[index].title,
                                );
                                Get.to(() => AddMedicine(
                                      add: "edit",
                                      recordid: mymedicine.medicinedata
                                              ?.productdata[index].id ??
                                          "",
                                      categoryname: mymedicine.medicinedata
                                              ?.productdata[index].catName ??
                                          "",
                                      categoryid: mymedicine.medicinedata
                                              ?.productdata[index].catId ??
                                          "",
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
                                                  "${AppUrl.imageurl}${mymedicine.medicinedata?.productdata[index].img ?? ""}",
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
                                          width: 8,
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
                                                        mymedicine
                                                                .medicinedata
                                                                ?.productdata[
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
                                              Row(
                                                children: [
                                                  Expanded(
                                                    child: Text(
                                                      mymedicine
                                                              .medicinedata
                                                              ?.productdata[
                                                                  index]
                                                              .catName ??
                                                          "",
                                                      maxLines: 1,
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
                                                    padding:
                                                        EdgeInsets.only(top: 8),
                                                    child: Column(
                                                      children: [
                                                        Text(
                                                          // "${currency}${mymedicine.medicinedata?.productdata[index].sprice ?? ""}",
                                                          "",
                                                          style: TextStyle(
                                                            fontSize: 17,
                                                            fontFamily:
                                                                FontFamily
                                                                    .gilroyBold,
                                                            color: blueColor,
                                                          ),
                                                        ),
                                                        Text(
                                                          // "${currency}${mymedicine.medicinedata?.productdata[index].aprice ?? ""}",
                                                          "",
                                                          style: TextStyle(
                                                            color: greycolor,
                                                            fontFamily: FontFamily
                                                                .gilroyMedium,
                                                          ),
                                                        ),
                                                      ],
                                                    ),
                                                  ),
                                                  SizedBox(
                                                    width: 10,
                                                  ),
                                                ],
                                              ),
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
                                          addmedicineController.getEditDetails(
                                            ecategory: mymedicine.medicinedata
                                                ?.productdata[index].catId,
                                            edescription: mymedicine
                                                .medicinedata
                                                ?.productdata[index]
                                                .description,
                                            eimage: mymedicine.medicinedata
                                                ?.productdata[index].img,
                                            estatus: mymedicine.medicinedata
                                                ?.productdata[index].status,
                                            etitle: mymedicine.medicinedata
                                                ?.productdata[index].title,
                                          );
                                          Get.to(() => AddMedicine(
                                                add: "edit",
                                                recordid: mymedicine
                                                        .medicinedata
                                                        ?.productdata[index]
                                                        .id ??
                                                    "",
                                                categoryname: mymedicine
                                                        .medicinedata
                                                        ?.productdata[index]
                                                        .catName ??
                                                    "",
                                                categoryid: mymedicine
                                                        .medicinedata
                                                        ?.productdata[index]
                                                        .catId ??
                                                    "",
                                              ));
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
