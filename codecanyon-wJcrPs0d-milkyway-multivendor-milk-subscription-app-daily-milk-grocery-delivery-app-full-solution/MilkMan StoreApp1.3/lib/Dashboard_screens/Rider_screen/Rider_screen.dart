// ignore_for_file: sort_child_properties_last, prefer_const_constructors, prefer_const_literals_to_create_immutables, unnecessary_brace_in_string_interps, file_names, avoid_print

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:storeappnew/Controller_class/Addrider_controller.dart';
import 'package:storeappnew/Controller_class/Rider_controller.dart';
import 'package:storeappnew/Dashboard_screens/Rider_screen/Add_Rider_screen.dart';
import 'package:storeappnew/api_screens/confrigation.dart';
import 'package:storeappnew/utils/Colors.dart';
import 'package:storeappnew/utils/Custom_widget.dart';
import 'package:storeappnew/utils/Fontfamily.dart';

class RiderScreen extends StatefulWidget {
  const RiderScreen({super.key});

  @override
  State<RiderScreen> createState() => _RiderScreenState();
}

class _RiderScreenState extends State<RiderScreen> {
  @override
  void initState() {
    super.initState();
    setState(() {
      riderlistController.riderlist();
    });
  }

  RiderlistController riderlistController = Get.put(RiderlistController());
  AddRiderController addRiderController = Get.put(AddRiderController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: WhiteColor,
      appBar: CustomAppbar(
          title: "Rider List",
          onTap: () {
            Get.to((() => AddRiderScreen(
                  add: "Add",
                )));
          }),
      body: Column(
        children: [
          SizedBox(
            height: 20,
          ),
          Expanded(
            child: Container(
              padding: EdgeInsets.symmetric(horizontal: 10),
              child: GetBuilder<RiderlistController>(builder: (context) {
                return riderlistController.isLoading
                    ? ListView.builder(
                        itemCount:
                            riderlistController.riderinfo?.riderdata.length,
                        physics: BouncingScrollPhysics(),
                        itemBuilder: (context, index) {
                          return Stack(
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
                                              "${AppUrl.imageurl}${riderlistController.riderinfo?.riderdata[index].img ?? ""}",
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
                                                  padding:
                                                      EdgeInsets.only(top: 30),
                                                  child: Text(
                                                    riderlistController
                                                            .riderinfo
                                                            ?.riderdata[index]
                                                            .title ??
                                                        "",
                                                    maxLines: 2,
                                                    style: TextStyle(
                                                      fontSize: 16,
                                                      fontFamily:
                                                          FontFamily.gilroyBold,
                                                      color: BlackColor,
                                                      overflow:
                                                          TextOverflow.ellipsis,
                                                    ),
                                                  ),
                                                ),
                                              ),
                                            ],
                                          ),
                                          SizedBox(height: Get.height * 0.015),
                                          GetBuilder<RiderlistController>(
                                              builder: (context) {
                                            return Row(
                                              children: [
                                                Expanded(
                                                  child: Text(
                                                    "${riderlistController.riderinfo?.riderdata[index].ccode} ${riderlistController.riderinfo?.riderdata[index].mobile}",
                                                    maxLines: 2,
                                                    style: TextStyle(
                                                      color: greyColor,
                                                      fontFamily: FontFamily
                                                          .gilroyMedium,
                                                      overflow:
                                                          TextOverflow.ellipsis,
                                                    ),
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
                                  border:
                                      Border.all(color: Colors.grey.shade200),
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
                                          "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!${riderlistController.riderinfo?.riderdata[index].id ?? ""}");
                                      Get.to(() => AddRiderScreen(
                                            add: "edit",
                                            recordid: riderlistController
                                                    .riderinfo
                                                    ?.riderdata[index]
                                                    .id ??
                                                "",
                                          ));
                                      addRiderController.getEditDetails(
                                          Editriderimage: riderlistController
                                              .riderinfo?.riderdata[index].img,
                                          EditRtitle: riderlistController
                                              .riderinfo
                                              ?.riderdata[index]
                                              .title,
                                          EditRideremail: riderlistController
                                              .riderinfo
                                              ?.riderdata[index]
                                              .email,
                                          EditRccode: riderlistController
                                              .riderinfo
                                              ?.riderdata[index]
                                              .ccode,
                                          EditRmobile: riderlistController
                                              .riderinfo
                                              ?.riderdata[index]
                                              .mobile
                                              .toString(),
                                          EditRpassword: riderlistController
                                              .riderinfo
                                              ?.riderdata[index]
                                              .password,
                                          estatus: riderlistController.riderinfo
                                              ?.riderdata[index].status);
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
    );
  }
}
