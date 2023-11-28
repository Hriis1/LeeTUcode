#include <iostream>
#include <vector>
#include <string>

int bustedFunc(int a, int b);


int main()
{
	if (bustedFunc(1, 2) != 3) {
		std::cout << "Input: " << "1,2" << std::endl;
		std::cout << "Your answer: " << bustedFunc(1, 2) << std::endl;
		std::cout << "Expected answer: " << 3 << std::endl;
		return 0;
	}

	if (bustedFunc(2, 5) != 7) {
		std::cout << "Input: " << "2,5" << std::endl;
		std::cout << "Your answer: " << bustedFunc(2, 5) << std::endl;
		std::cout << "Expected answer: " << 7 << std::endl;
		return 0;
	}

	if (bustedFunc(5, 5) != 10) {
		std::cout << "Input: " << "5,5" << std::endl;
		std::cout << "Your answer: " << bustedFunc(5, 5) << std::endl;
		std::cout << "Expected answer: " << 10 << std::endl;
		return 0;
	}



	std::cout << "All tests cleared!";
	return 0;
}

int bustedFunc(int a, int b)
{
	return a + b;
}