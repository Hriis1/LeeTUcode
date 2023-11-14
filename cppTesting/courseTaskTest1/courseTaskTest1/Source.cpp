#include <iostream>
#include <vector>
#include <string>

int testFunc(std::vector<int> vec, int x);


int main()
{
	if (testFunc({ 1,3,5 }, 2) != 15)
	{
		std::cout << "Input: " << "{ 1,3,5 }, 2" << std::endl;
		std::cout << "Your answer: " << testFunc({ 1,3,5 }, 2) << std::endl;
		std::cout << "Expected answer: " << 16 << std::endl;

		return 0;
	}

	std::cout << "All tests cleared!" << std::endl;
	return 0;
}

int testFunc(std::vector<int> vec, int x)
{
	int ans = 0;
	for (size_t i = 0; i < vec.size(); i++)
	{
		ans +=vec[i] + x;
	}

	return ans;
}